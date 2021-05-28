<!-- 마이페이지 -->
<?php    
   	$con = mysqli_connect("localhost", "eunseo", "1205", "diary");
    $sql    = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];

    $email = explode("@", $row["email"]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con);
?>

<section>
    <div id="main_content">
    <div id="join_box">
        <!-- 수정 후 'saveBtn' 누른 후 member_modify.js에서 submit() 하면 member_modify.php에서 실제로 업데이트됨 -->
        <form  name="member_form" method="post" action="./php/member_modify.php?id=<?=$userid?>">
        
        <h2>회원 정보 수정</h2>
        <div class="form id">
            <div class="col1">아이디</div>
            <div class="col2">
                <?= $userid ?>
            </div>
        </div>
        <div class="clear"></div>

        <div class="form">
            <div class="col1">비밀번호</div>
            <div class="col2">
            <input type="password" name="pass" value="<?= $pass?>"/>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form">
            <div class="col1">비밀번호 확인</div>
            <div class="col2">
            <input type="password" name="pass_confirm" value="<?= $pass?>"/>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form">
            <div class="col1">이름</div>
            <div class="col2">
            <input type="text" name="name" value="<?= $name?>"/>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form email">
            <div class="col1">이메일</div>
            <!-- <div class="col2"><input type="text" name="email" /></div> -->
            <div class="col2"><input type="text" name="email1" value="<?= $email1?>"/>&nbsp;@&nbsp;<input type="text" name="email2"value="<?= $email2?>" /></div>
        </div>
        <div class="clear"></div>
        <div class="bottom_line"></div>
        <div class="buttons">
            <span class="saveBtn">수정하기</span>
            <span class="resetBtn">취소하기</span>
            <!-- <img style="cursor: pointer" src="./img/button_save.gif" onclick="check_input()" />&nbsp;
            <img id="reset_button" style="cursor: pointer" src="./img/button_reset.gif" onclick="reset_form()" /> -->
        </div>
        </form>
    </div>
    <!-- join_box -->
    </div>
    <!-- main_content -->
</section>
