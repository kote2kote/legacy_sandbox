<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author nagatayorinobu
 */
class BaseController {
    protected $type;
    protected $action;
    protected $next_type;
    protected $next_action;
    protected $file;
    protected $form;
    protected $renderer;
    protected $auth;
    protected $is_system = false;
    protected $view;
    protected $title;
    protected $message;
    protected $auth_error_mess;
    protected $login_state;
    private   $debug_str;
    
    public function __construct($flag=false){
        $this->set_system($flag);
        // VIEWの準備
        $this->view_initialize();
    }
    

    public function set_system($flag){
        $this->is_system = $flag;
    }
    
    private function view_initialize(){
        // 画面表示クラス
        $this->view = new Smarty();
        // Smarty関連ディレクトリの設定
        $this->view->template_dir = _SMARTY_TEMPLATES_DIR;
        $this->view->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
        $this->view->config_dir   = _SMARTY_CONFIG_DIR;
        $this->view->cache_dir    = _SMARTY_CACHE_DIR;

        // 入力チェック用クラス
        $this->form = new HTML_QuickForm2('Form');
        HTML_QuickForm2_Renderer::register('smarty','HTML_QuickForm2_Renderer_Smarty');
        $this->renderer  = HTML_QuickForm2_Renderer::factory('smarty');
        $this->renderer->setOption('old_compat', true);
        $this->renderer->setOption('group_errors', false);

        // リクエスト変数 typeとactionで動作を決めます。
        if(isset($_REQUEST['type'])){   $this->type   = $_REQUEST['type'];}
        if(isset($_REQUEST['action'])){ $this->action = $_REQUEST['action'];}

        // 共通の変数
        $this->view->assign('is_system',   $this->is_system );
        $this->view->assign('SCRIPT_NAME', _SCRIPT_NAME);
        $this->view->assign('add_pageID',  $this->add_pageID());
    }


    //----------------------------------------------------
    // フォームと変数を読み込んでテンプレートに組み込んで表示します。
    //----------------------------------------------------
    protected function view_display(){
        // セッション変数などの内容の表示
        $this->debug_display();

        // ログイン状況の表示
        $this->disp_login_state();
        
        $this->view->assign('title', $this->title);
        $this->view->assign('auth_error_mess', $this->auth_error_mess);
        $this->view->assign('message', $this->message);
        $this->view->assign('disp_login_state', $this->login_state);
        $this->view->assign('type',    $this->next_type);
        $this->view->assign('action',  $this->next_action);
        $this->view->assign('debug_str', $this->debug_str);

        $this->view->assign('form', $this->form->render($this->renderer)->toArray());
        $this->view->display($this->file);

        // デバッグ用
        //echo "<b>toArray()</b><pre>";var_dump($this->renderer->toArray());echo "</pre>";
        //print "<hr>";
        //echo "<b>form</b><pre>";var_dump($this->form);echo "</pre>";

    }
    
    //----------------------------------------------------
    // ログイン中の表示
    //----------------------------------------------------
    private function disp_login_state(){
        if(is_object($this->auth) && $this->auth->check()){
            $this->login_state = ($this->is_system)? '管理者ログイン中' : '会員ログイン中';
        }
    }    
    
    
    //----------------------------------------------------
    // 会員情報入力項目と入力ルールの設定
    //----------------------------------------------------
    public function make_form_controle(){
        $KenModel = new KenModel;
        $ken_array = $KenModel->get_ken_data();
        $options = [
            'format'    => 'Ymd',
            'minYear'   => 1950,
            'maxYear'   => date("Y"),
        ];
        $username =  $this->form->addElement('text',  'username',  ['size' => 30], ['label' => 'メール（ユーザーネーム）'] );
        $password =  $this->form->addElement('password',  'password',  ['size' => 30], ['label' => 'パスワード'] );
        $last_name = $this->form->addElement('text',  'last_name', ['size' => 30], ['label' => '氏'] );
        $first_name= $this->form->addElement('text',  'first_name',['size' => 30], ['label' => '名'] );
        $birthday =  $this->form->addElement('date',  'birthday',  null, ['label' => '誕生日'] + $options);
        $ken =       $this->form->addElement('select','ken',       null, ['label' => '県名', 'options' => $ken_array] );

        $username->addRule('required', 'メールアドレスを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $username->addRule('email',  'メールアドレスの形式が不正です。',    null, HTML_QuickForm2_Rule::SERVER);
        $password->addRule('required',  'パスワードを入力してください。',      null, HTML_QuickForm2_Rule::SERVER);
        $password->addRule('length',  'パスワードは8文字から16文字の範囲で入力してください。', [8, 16], HTML_QuickForm2_Rule::SERVER);
        $password->addRule('regex',  'パスワードは半角の英数字、記号（ _ - ! ? # $ % & ）を使ってください。', '/^[a-zA-z0-9_\-!?#$%&]*$/', HTML_QuickForm2_Rule::SERVER);
        $last_name->addRule('required', '氏を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $first_name->addRule('required','名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);

        $this->form->addRecursiveFilter('trim');

    }
    
    
    //----------------------------------------------------
    // 検索処理関係
    //----------------------------------------------------
    //
    // pageIDをURLに追加。
    //
    public function add_pageID(){
        if( !($this->is_system && $this->type == 'list') ){ return;}

        $add_pageID = "";
        if(isset($_GET['pageID']) && $_GET['pageID'] != ""){
            $add_pageID = '&pageID=' . $_GET['pageID'];
            $_SESSION['pageID'] = $_GET['pageID'];
        }else if(isset($_SESSION['pageID']) && $_SESSION['pageID'] != ""){
            $add_pageID = '&pageID=' . $_SESSION['pageID'];
        }
        return $add_pageID;
    }

    //----------------------------------------------------
    // ページ分割処理
    //----------------------------------------------------
    public function make_page_link($data){
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode'      => 'Jumping',
            'perPage'   => 10,
            'delta'     => 10,
            'itemData'  => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data  = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }    

    //----------------------------------------------------
    // デバッグ用表示処理
    //----------------------------------------------------
    public function debug_display(){
        if(_DEBUG_MODE){
            $this->debug_str = "";
            if(isset($_SESSION)){
                $this->debug_str .= '<br><br>$_SESSION<br>';
                $this->debug_str .= var_export($_SESSION, TRUE);
            }
            if(isset($_POST)){
                $this->debug_str .= '<br><br>$_POST<br>';
                $this->debug_str .= var_export($_POST, TRUE);
            }
            if(isset($_GET)){
                $this->debug_str .= '<br><br>$_GET<br>';
                $this->debug_str .= var_export($_GET, TRUE);
            }
            // smartyのデバッグモード設定 ポップアップウィンドウにテンプレート内の変数を
            // 表示します。
            $this->view->debugging = _DEBUG_MODE;
        }
    }
}
