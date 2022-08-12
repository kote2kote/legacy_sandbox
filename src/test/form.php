<?php
/*
	Template Name: page-basic-php-form-validate
*/

// ==================================================
// form_basic
// ==================================================
// バリデーションを含む、入力→確認→送信の例
session_start();
header('X-FRAME-OPTIONS:DENY');


// --------------------------------------------------
// 関数
// --------------------------------------------------

// -- XSS対策。html表示は必ず使う -------------- //
function h($str)
{
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function is_checked_iekei($item_name) {
  if(!empty($_REQUEST['iekei'])){
    foreach($_REQUEST['iekei'] as $name => $value) {
      if($value === $item_name) {
        return true;
      }
    }
  }
}

// -- バリデーション -------------- //
function validation($request){ //$_POST連想配列

  $errors = [];

  // 必須チェックはemptyで行う
  // php8対策
  if(!isset($request['username']) || 20 < mb_strlen($request['username']) ){
    $errors[] = '「氏名」は必須です。20文字以内で入力してください。'. (20 < mb_strlen(isset($request['username']))) ; 
  }

  // if(empty($request['username']) || 20 < mb_strlen($request['username']) ){
  //   $errors[] = '「氏名」は必須です。20文字以内で入力してください。'. (20 < mb_strlen($request['username'])) ; 
  // }

  /*
  // 文字数チェック
  if(empty($request['usename']) || 20 < mb_strlen($request['username']) ){
    $errors[] = '「氏名」は必須です。20文字以内で入力してください。'; 
  }

  // Emailバリデートチェック
  if(empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
    $errors[] = '「メールアドレス]は必須です。正しい形式で入力してください。';
  }

  // URLバリデートチェック
  if(!empty($request['url'])){
    if(!filter_var($request['url'], FILTER_VALIDATE_URL)){
      $errors[] = '「ホームページ」は正しい形式で入力してください。';
    }
  }

  // 必須チェック
  if(!isset($request['gender'])){
    $errors[] = '「性別」は必須です。';
  }

  // 数値<>チェック
  if(empty($request['age']) || 6 < $request['age']){
    $errors[] = '「年齢」は必須です。' ;
  }
  
  // 文字数チェック
  if(empty($request['contact']) || 200 < mb_strlen($request['contact']) ){
    $errors[] = '「お問い合わせ内容」は必須です。200文字以内で入力してください。'; 
  }

  // 必須チェック
  if(empty($request['caution'])){
    $errors[] = '「注意事項」をご確認ください。';
  }
*/
  return $errors;
}

// ==================================================
// フラグ管理
// ==================================================
// -- 変数フラグ -------------- //
$form_flag = [
  'is_confirm' => 0, // 確認
  'is_submit' => 0 // 送信
];


// -- フラグコントロール -------------- //
if(!empty($_REQUEST['btn_confirm'])&& empty($errors)){
  $form_flag['is_confirm'] = 1;
}
if(!empty($_REQUEST['btn_submit'])){
  $form_flag['is_submit'] = 1;
}
if(!empty($_REQUEST['back'])){
  $form_flag['back'] = 1;
}

// -- トークンコントロール -------------- //
if($form_flag['is_submit'] !== 1){
  if(empty($_SESSION['csrfToken'])){
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrfToken'] = $csrfToken;
  }
  $token = $_SESSION['csrfToken'];
}

$errors = validation($_POST);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="format-detection" content="email=no,telephone=no,address=no" />
  <meta name="description" content="" />
  <title>starter</title>
  <link rel="stylesheet" href="/assets/css/style.css" />
</head>

<body id="Body" class="test-form">
  <div class="w-full com_h">
    <div class="inner">
      <h1>page-basic-php-form-validate</h1>
      <section id="Form" class="px-8">
        <h2 class="mb-4 com_h">JSとPHPのバリデーションも完璧なフォーム</h2>

        <h3 class="com_h mb-4">JSのバリデート範囲はチェック完了で確認ボタンをオンにすること</h3>
        <?php if($form_flag['is_submit'] !== 1){ ?>

        <?php if(!empty($errors) && !empty($_POST['btn_confirm']) ) { ?>
        <ul>
          <?php foreach($errors as $error){?>
          <li><?php echo $error ; ?></li>
          <?php } ?>
        </ul>
        <?php };?>

        <!--==================================================
        Form
      ==================================================-->
        <form id="form" action="/test/form.php" method="post">


          <!-- Username --------------------------------------------------->

          <p class="form-el_username pb-8">
            <label class=" inline-block w-1/2">
              <span class="font-bold">Username</span><br />
              <span><?php if(!empty($_REQUEST['username']) && empty($_REQUEST['back'])){echo h($_REQUEST['username']) ;}?></span>
              <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
              <input @change='usernameChangeHandler' type="text" name="username" v-model.trim="form.username" class="w-full block" placeholder="Enter username" value="<?php if(!empty($_REQUEST['username'])){echo $_REQUEST['username'] ;}?>" />
              <span class="error inline-block" :class="[validateFlag.username || !validateFlag.start ? 'hidden' : 'block']">Error message</span>
              <?php } ?>
            </label>

            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <input type="hidden" name="username" value="<?php echo h($_REQUEST['username']) ;?>">
            <?php } ?>
          </p>


          <!-- Email --------------------------------------------------->

          <p class="form-el_email pb-8">
            <label class="inline-block w-1/2">
              <span class="font-bold">Email</span><br />
              <span><?php if(!empty($_REQUEST['email']) && empty($_REQUEST['back'])){echo h($_REQUEST['email']) ;}?></span>
              <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
              <input @change="emailChangeHandler" type="email" name="email" class="w-full inline-block" placeholder="Enter email" value="<?php if(!empty($_REQUEST['email'])){echo $_REQUEST['email'] ;}?>" /><br />
              <span class="error inline-block hidden" :class="{'block':validateFlag.email}">Error message</span>
              <?php } ?>
            </label>

            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <input type="hidden" name="email" value="<?php echo h($_REQUEST['email']) ;?>">
            <?php } ?>
          </p>


          <!-- 好きなラーメンはなんですか？ --------------------------------------------------->

          <fieldset class="form-el_ramen pb-8">
            <legend class="font-bold inline-block">好きなラーメンはなんですか？</legend>
            <span><?php if(!empty($_REQUEST['ramen']) && empty($_REQUEST['back'])){echo $_REQUEST['ramen'] ;}?></span>
            <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
            <span class="hidden error inline-block">Error message</span><br />
            <label class="inline-block">
              <input type="radio" name="ramen" class="inline-block" required value="醤油ラーメン" <?php if(!empty($_REQUEST['ramen'])){if($_REQUEST['ramen'] === '醤油ラーメン' ){ echo 'checked'; } ;}?>>
              <span>醤油ラーメン</span>
            </label><br />

            <label class="inline-block">
              <input type="radio" name="ramen" class="inline-block" required value="塩ラーメン" <?php if(!empty($_REQUEST['ramen'])){if($_REQUEST['ramen'] === '塩ラーメン' ){ echo 'checked'; } ;}?>>
              <span>塩ラーメン</span></label><br />

            <label class="inline-block">
              <input type="radio" name="ramen" class="inline-block" required value="豚骨ラーメン" <?php if(!empty($_REQUEST['ramen'])){if($_REQUEST['ramen'] === '豚骨ラーメン' ){ echo 'checked'; } ;}?>>
              <span>豚骨ラーメン</span></label>
            <?php } ?>

            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <input type="hidden" name="ramen" value="<?php echo $_REQUEST['ramen'] ;?>">
            <?php } ?>
          </fieldset>


          <!-- 好きな家系の注文はなんですか？ ------------------------------------------------------->

          <fieldset class="form-el_ieramen pb-8">
            <legend class="font-bold inline-block">好きな家系の注文はなんですか？</legend>
            <?php 

          if (!empty($_REQUEST['iekei'])&& empty($_REQUEST['back'])){ 
            // $iekei = $_REQUEST['iekei'];

            if ($_REQUEST['iekei'] ){ 
           ?>
            <ul>
              <?php foreach ($_REQUEST['iekei'] as $name => $value) { ?>
              <li><?php echo $value; ?></li>
              <?php } ?>
            </ul>
            <?php } ?>
            <?php } ?>

            <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
            <span class="hidden error inline-block">Error message</span><br />

            <label class="inline-block">
              <input type="checkbox" name="iekei[katame]" class="inline-block" value="かため" <?php if(is_checked_iekei("かため")){echo 'checked';}; ?>>
              <span>かため</span>
            </label><br />

            <label class="inline-block">
              <input type="checkbox" name="iekei[koime]" class="inline-block" value="こいめ" <?php if(is_checked_iekei("こいめ")){echo 'checked';}; ?>>
              <span>こいめ</span></label><br />

            <label class="inline-block">
              <input type="checkbox" name="iekei[oome]" class="inline-block" value="おおめ" <?php if(is_checked_iekei("おおめ")){echo 'checked';}; ?>>
              <span>おおめ</span></label>
            <?php } ?>
            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <?php foreach ($_REQUEST['iekei'] as $name => $value) { ?>
            <input type="hidden" name="iekei[<?php echo $name; ?>]" value="<?php echo $value;?>">
            <?php } ?>
            <!-- <input type="hidden" name="iekei[katame]" value="<?php //echo $_REQUEST['iekei[katame]']?>">
          <input type="hidden" name="iekei[koime]" value="<?php //echo $_REQUEST['iekei[koime]']?>">
          <input type="hidden" name="iekei[oome]" value="<?php //echo $_REQUEST['iekei[oome]']?>"> -->
            <?php } ?>
          </fieldset>


          <!-- 好きなラーメンの具はなんですか？ ------------------------------------------------------->

          <p class="form-el_ramen-gu pb-8">
            <label class="inline-block w-1/2"><span class="font-bold">好きなラーメンの具はなんですか？</span>
              <br />
              <span><?php if(!empty($_REQUEST['ramengu']) && empty($_REQUEST['back'])){echo $_REQUEST['ramengu'] ;}?></span>
              <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
              <select name="ramengu" class="w-full">
                <option value="" <?php if(!isset($_REQUEST['ramengu'])){echo 'selected';} ?>>選択してください</option>
                <option value="ほうれんそう" <?php if(isset($_REQUEST['ramengu']) === "ほうれんそう"){echo 'selected';} ?>>ほうれんそう</option>
                <option value="のり" <?php if(isset($_REQUEST['ramengu']) === "のり"){echo 'selected';} ?>>のり</option>
                <option value="味玉" <?php if(isset($_REQUEST['ramengu']) === "味玉"){echo 'selected';} ?>>味玉</option>
                <option value="おろしにんにく" <?php if(isset($_REQUEST['ramengu']) === "おろしにんにく"){echo 'selected';} ?>>おろしにんにく</option>
                <option value="豆板醤" <?php if(isset($_REQUEST['ramengu']) === "豆板醤"){echo 'selected';} ?>>豆板醤</option>
              </select><br />
              <span class="hidden error inline-block">Error message</span>
              <?php } ?>
            </label>

            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <input type="hidden" name="ramengu" value="<?php echo isset($_REQUEST['ramengu']) ;?>">
            <?php } ?>
          </p>

          <!-- なにか一言! ------------------------------------------------------->

          <p class="form-el_hitokoto pb-8">
            <label class="inline-block w-1/2"><span class="font-bold">なにか一言!</span>
              <br />
              <span><?php if(!empty($_REQUEST['hitokoto']) && empty($_REQUEST['back'])){echo h($_REQUEST['hitokoto']) ;}?></span>
              <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
              <textarea name="hitokoto" class="w-64 h-24"><?php if(!empty($_REQUEST['hitokoto'])){echo h($_REQUEST['hitokoto']) ;}?></textarea>
              <br />
              <span class="hidden error inline-block">Error message</span>
              <?php } ?>
            </label>

            <!-- hidden -->
            <?php if($form_flag['is_confirm'] === 1){ ?>
            <input type="hidden" name="hitokoto" value="<?php echo h($_REQUEST['hitokoto']) ;?>">
            <?php } ?>
          </p>

          <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>


          <!-- Password ------------------------------------------------------->

          <p class="form-el_password pb-8">
            <label class="inline-block w-1/2">
              <span class="font-bold">Password</span><br />
              <input type="password" name="password" class="w-full inline-block" placeholder="Enter password" /><br />
              <span class="hidden error inline-block">Error message</span>
            </label>
          </p>


          <!-- Confirm Password ------------------------------------------------------->

          <p class="form-el_password2 pb-8">
            <label class="inline-block w-1/2">
              <span class="font-bold">Confirm Password</span><br />
              <input type="password" name="password2" class="w-full inline-block" placeholder="Enter password again" /><br />
              <span class="hidden error inline-block">Error message</span>
            </label>
          </p>
          <?php } else { ?>
          <p>パスワード記入済み</p>
          <!-- hidden -->
          <input type="hidden" name="password" value="<?php echo h($_REQUEST['password']) ;?>">
          <input type="hidden" name="password2" value="<?php echo h($_REQUEST['password2']) ;?>">
          <input type="hidden" name="csrf" value="<?php echo $token; ?>">
          <?php } ?>

          <!-- ボタン ------------------------------------------------------->

          <?php if($form_flag['is_confirm'] === 0 && $form_flag['is_submit'] === 0){ ?>
          <!-- 入力ページ: 確認ボタン表示と$tokeの発行 -->
          <input type="submit" name="btn_confirm" class="btn" value="確認する" :disabled="!isAllChecked">
          <input type="hidden" name="csrf" value="<?php echo $token; ?>">
          <?php } else { ?>
          <!-- 確認ページ: $tokenの確認(csrf:クリックジャンキング) -->
          <?php if($form_flag['is_confirm'] === 1 && $_REQUEST['csrf'] === $_SESSION['csrfToken']){ ?>
          <input type="submit" name="back" value="戻る" class="btn mr-4">
          <input type="submit" name="btn_submit" value="送信する" class="btn">

          <?php } ?>
          <?php } ?>
        </form>
        <?php } ?>


        <!-- 完了画面
      ------------------------------------------------------->
        <?php if($form_flag['is_submit'] === 1){ ?>
        <?php if($_REQUEST['csrf'] === $_SESSION['csrfToken']){ ?>
        <p>情報を送信しました</p>
        <p><?php var_dump($_REQUEST); ?></p>
        <p><span class="font-bold">Username</span><br /><?php echo $_REQUEST['username'] ?></p>
        <p><span class="font-bold">Email</span><br /><?php echo $_REQUEST['email'] ?></p>
        <p><span class="font-bold">好きなラーメンはなんですか？</span><br /><?php echo $_REQUEST['ramen'] ?></p>
        <p><span class="font-bold">好きな家系の注文はなんですか？</span><br />
          <?php
      if (!empty($_REQUEST['iekei'])){ 
            if ($_REQUEST['iekei'] ){ 
           ?>
        <ul>
          <?php foreach ($_REQUEST['iekei'] as $name => $value) { ?>
          <li><?php echo $value; ?></li>
          <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?></p>
        <p><span class="font-bold">好きなラーメンの具はなんですか？</span><br /><?php echo $_REQUEST['ramengu'] ?></p>
        <h4>パスワード確認用</h4>
        <p><span class="font-bold">Password</span><br /><?php echo $_REQUEST['password'] ?></p>
        <p><span class="font-bold">Confirm Password</span><br /><?php echo $_REQUEST['password2'] ?></p>
        <?php unset($_SESSION['csrfToken']); ?>
        <?php } ?>
        <?php } ?>

      </section>
      <footer class="cm h-40">ここはhtmlのフッターです</footer>
    </div>
  </div>


  <script src="https://unpkg.com/vue@next"></script>
  <!-- <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.production.min.js"></script> -->
  <script src="/assets/js/single/test/validate.js"></script>
</body>

</html>