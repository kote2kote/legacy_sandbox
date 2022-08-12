<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticeController
 *
 * @author nagatayorinobu
 */
class NoticeController extends BaseController {

    //----------------------------------------------------
    // お知らせの修正
    //----------------------------------------------------
    public function screen_modify(){
        // データベースを操作します。
        $NoticeModel = new NoticeModel;
        $noticedata = $NoticeModel->get_notice_data_id('1');
        
        // 現在のお知らせを設定します。
        $this->form->addDataSource(new HTML_QuickForm2_DataSource_Array(
            [
                'subject'  => $noticedata['subject'],
                'body'     => $noticedata['body']
            ]
        ));
        $this->form->addElement('text',    'subject', ['size' => 50, 'maxlength' => 100 ], [ 'label' => '件名']);
        $this->form->addElement('textarea','body',    ['rows'=> 5, 'cols'=> 40], [ 'label' => '内容']);

        if($this->action == "form"){
            $this->next_type    = 'notice';
            $this->next_action  = 'complete';
            $this->form->addElement('submit','submit', '更新する');
            $this->file = "notice_form.tpl";
        }else if($this->action == "complete"){
            $userdata = $this->form->getValue();
            $userdata['id'] = '1';
            $NoticeModel->modify_notice($userdata);
            $this->message = "お知らせを更新しました。";
            $this->file = "message.tpl";
        }
        $this->title  = 'お知らせ画面';
        $this->view_display();
    }    
}
