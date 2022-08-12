<?php
class Test
{
    public function TestPublic() {
	print "公開<br>";
    }

    function TestNothing(){
    	print "宣言なし<br>";
    }

    private   function TestPrivate() { 
  	print "秘密<br>";
    }

}

$test = new Test();
$test->TestPublic();
$test->TestNothing();
$test->TestPrivate();// この部分だけエラーになります。

?>
