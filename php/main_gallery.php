<section class="board">
   	<div id="board_box">
	    <h3>
        ๐๏ธTrend
		  </h3>
        <span class="selectBtn"><a href="main_screen_by_date.php">์ต์ ๊ธ</a></span>
	    <ul id="board_list">
				<li>
          <!-- ๊ฐ๊ฐ์ ๊ฒ์๋ฌผ ์นด๋ -->
                <?php
                    if (isset($_GET["page"]))
                        $page = $_GET["page"];
                    else
                        $page = 1;

                    $con = mysqli_connect("localhost", "root", "s6139350!", "diary");
                    $sql = "select * from board order by hit desc"; // ์กฐํ์ ๋ง์ ์์
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result); // ์ ์ฒด ๊ธ ์

                    $scale = 12;
                    // $scale = 1;

                    // ์ ์ฒด ํ์ด์ง ์($total_page) ๊ณ์ฐ 
                    if ($total_record % $scale == 0)     
                        $total_page = floor($total_record/$scale);      
                    else
                        $total_page = floor($total_record/$scale) + 1; 

                    // ํ์ํ  ํ์ด์ง($page)์ ๋ฐ๋ผ $start ๊ณ์ฐ  
                    $start = ($page - 1) * $scale;      
                    $number = $total_record - $start;

                for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
                {
                    mysqli_data_seek($result, $i);
                    // ๊ฐ์ ธ์ฌ ๋ ์ฝ๋๋ก ์์น(ํฌ์ธํฐ) ์ด๋
                    $row = mysqli_fetch_array($result);
                    // ํ๋์ ๋ ์ฝ๋ ๊ฐ์ ธ์ค๊ธฐ
                    $num         = $row["num"];
                    $id          = $row["id"];
                    $name        = $row["name"];
                    $subject     = $row["subject"];
                    $regist_day  = $row["regist_day"];
                    $hit         = $row["hit"];
                    $file_type   = $row["file_type"];
                    $file_copied = $row["file_copied"];
                    $content     = $row["content"];
                    //======================================= ์ด๋ฏธ์ง ์ฒ๋ฆฌ
                    if ($file_type == "image/jpeg" || $file_type == "image/png") {
                        $image_file_image = "<img src='upload/{$file_copied}' class='image_file'>";
                    }
                    else {
                        $image_file_image = "<img src='img/Daily.jpg' class='image_file'>";
                    }
                    //=======================================
                ?>
                <li>
                    <div class="card">
                    <a href="board_view_screen.php?num=<?=$num?>&page=<?=$page?>">
                        <div class="image_file"><?php echo $image_file_image; ?></div>
                        <div class="board_list_block">
                            <!-- <span class="col1"><?=$number?></span> -->
                            <div class="row1"><?=$subject?></div>
                            <div class="row2">
                                <span class="name">๊ธ์ด์ด ยท <?=$name?></span>
                                <!-- hit: ์กฐํ์ -->
                                <span class="hits">์กฐํ์ ยท <?=$hit?></span>
                            </div>
                            <div class="row3"><?=$content?></div>
                        </div>
                    </a>
                  </div>
                </li>	
            <?php
                $number--;
            }
            mysqli_close($con);
            ?>
				</li>
      </ul>
			<ul id="page_num"> 	
        <?php
            if ($total_page>=2 && $page >= 2)	
            {
                $new_page = $page-1;
                echo "<li><a href='main_screen.php?page=$new_page'>โ</a> </li>";
            }		

            // ๊ฒ์ํ ๋ชฉ๋ก ํ๋จ์ ํ์ด์ง ๋งํฌ ๋ฒํธ ์ถ๋ ฅ
            for ($i=1; $i<=$total_page; $i++)
            {
                if ($page == $i)     // ํ์ฌ ํ์ด์ง ๋ฒํธ ๋งํฌ ์ํจ
                {
                    echo "<li><b>$i</b></li>";
                }
                else
                {
                    echo "<li><a href='main_screen.php?page=$i'>$i</a></li>";
                }
            }
            if ($total_page>=2 && $page != $total_page)		
            {
                $new_page = $page+1;	
                echo "<li> <a href='main_screen.php?page=$new_page'>โถ</a></li>";
            }
        ?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li>
                <?php 
                    if($userid) {
                ?>
					<button onclick="location.href='board_form_screen.php'">๊ธ์ฐ๊ธฐ</button>
                <?php
                    } else {
                ?>
					<a href="javascript:alert('๋ก๊ทธ์ธ ํ ์ด์ฉํด ์ฃผ์ธ์!')"><button>๊ธ์ฐ๊ธฐ</button></a>
                <?php
                    }
                ?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section> 
