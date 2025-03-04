<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';

$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE ( slug='$slug') ");
$resume = $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id']." ) ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=".$resume['id']." ) ");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=".$resume['id']." ) ");
$skills = $skills->fetch_all(1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Exo&family=Fuggles&family=Gloria+Hallelujah&family=Mooli&family=Nunito&family=Zilla+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title><?=$resume['full_name'].' | '.$resume['resume_title']?></title>
</head>

<body>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            
            font-size: 12pt;

            background: rgb(249, 249, 249);
            background: radial-gradient(circle, rgba(249, 249, 249, 1) 0%, rgba(240, 232, 127, 1) 49%, rgba(246, 243, 132, 1) 100%);
            background-image: url(./assets/images/tiles/<?=$resume['background']?>);
            background-attachment: fixed;

        }

        * {
            margin: 0px;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {

            width: 21cm;
            min-height: 29.7cm;
            padding: 0.5cm;
            margin: 0.5cm auto;
            /* border: 1px #D3D3D3 solid; */
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {


            /* height: 256mm; */


        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        * {
            transition: all .2s;
        }

        table {
            border-collapse: collapse;
        }

        .pr {
            padding-right: 30px;
        }

        .pd-table td {
            padding-right: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
        }
    </style>

<?php
if($fn->Auth()!=false && $fn->Auth()['id']==$resume['user_id']){
    ?>
<div class="extra">
<div class="w-100 py-2 bg-dark d-flex justify-content-center gap-3">
    <?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
<a href="whatsapp://send?text=<?=$actual_link?>" class="btn btn-light btn-sm"><i class="bi bi-whatsapp"></i> Share</a>
<button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i> Print</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#background"><i class="bi bi-backpack4-fill"></i> Background</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-file-earmark-font"></i> Font</button>
<button class="btn btn-light btn-sm" id="downloadpdf"><i class="bi bi-file-earmark-pdf"></i> </i> Download</button>
</div>
    </div>
    <?php
}
?>


<div class="page" style="font-family:<?=$resume['font']?>">
    <div class="subpage">
        <table class="w-100">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold fs-4">Resume</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="personal-info zsection">
                        <div class="fw-bold name"><?=$resume['full_name']?></div>
                        <div>Mobile : <span class="mobile">+91-<?=$resume['mobile_no']?></span></div>
                        <div>Email : <span class="email"><?=$resume['email_id']?></span></div>
                        <div>Address : <span class="address"><?=$resume['address']?></span></div>
                        <hr>
                    </td>
                </tr>

                <tr class="objective-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Objective</td>
                    <td class="pb-3 objective">
                       <?=$resume['objective']?>
                    </td>
                </tr>

                <tr class="experience-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Experience</td>
                    <td class="pb-3 experiences">

                    <?php
if($exps){
foreach($exps as $exp){
    ?>
 <div class="experience mb-2">
                            <div class="fw-bold">- <span class="job-role"><?=$exp['position']?>
                            </div>
                            <div class="company"><?=$exp['company']?></div>
                            <div><span class="working-from"><?=$exp['started']?></span> – <span class="working-to"><?=$exp['ended']?></span></div>
                            <div class="work-description"><?=$exp['job_desc']?></div>
                        </div>

    <?php
}
}else{
?>
<div class="experience mb-2">
                           
                            <div class="company">I am a Fresher.</div>
                        
                        </div>
<?php
}
                    ?>

                       

                    </td>
                </tr>

                <tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Education</td>
                    <td class="pb-3 educations">


                    
                    <?php
if($edus){
foreach($edus as $edu){
    ?>
<div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?=$edu['course']?></span></div>
                            <div class="institute"><?=$edu['institute']?></div>
                               <div><span class="working-from"><?=$edu['started']?></span> – <span class="working-to"><?=$edu['ended']?></span></div>
                        </div>

    <?php
}
}else{
?>
<div class="education mb-2">
                           
                            <div class="institute">I don't have any education</div>
                        
                        </div>
<?php
}
                    ?>

                        




                    </td>
                </tr>

                <tr class="skills-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Skills</td>
                    <td class="pb-3 skills">
<?php
if($skills){
foreach($skills as $skill){
    ?>
 <div class="skill">- <?=$skill['skill']?></div>
    <?php
}
}else{
?>
 <div class="skill">- I don't have any skills.</div>
<?php
}
?>
                     

                    </td>
                </tr>

                <tr class="personal-details-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Personal Details</td>
                    <td class="pb-3">
                        <table class="pd-table">
                            <tr>
                                <td>Date of Birth</td>
                                <td>: <span class="date-of-birth"><?=date('d F Y',strtotime($resume['dob']))?></span></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>: <span class="gender"><?=$resume['gender']?></span></td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>: <span class="religion"><?=$resume['religion']?></span></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>: <span class="nationality"><?=$resume['nationality']?></span></td>
                            </tr>
                            <tr>
                                <td>Marital Status</td>
                                <td>: <span class="marital-status"><?=$resume['marital_status']?></span></td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>: <span class="hobbies"><?=$resume['hobbies']?></span></td>
                            </tr>

                        </table>

                    </td>
                </tr>

                <tr class="languages-known-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Languages Known</td>
                    <td class="pb-3 languages">

                       <?=$resume['languages']?>
                    </td>
                </tr>

                <tr class="declaration-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Declaration</td>
                    <td class="pb-5 declaration">
                        I hereby declare that above information is correct to the best of my
                        knowledge and can be supported by relevant documents as and when
                        required.
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
                    <div class="px-3">Date : <?=date('d F, Y',$resume['updated_at'])?></div>
                    <div class="px-3 name text-end"><?=$resume['full_name']?></div>

</div>
    </div>

</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="background" style="height:50vh" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title w-100" id="offcanvasBottomLabel">Change Background</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body w-100">
    <style>
.tile{
    width:100px;
    height:100px;
    background-size:cover;+
}
.tile:hover{
    cursor:pointer;
    opacity:0.7;
}
        </style>
        <div class="d-flex w-100 gap-2 flex-wrap justify-content-center">
            <?php
for($i=1;$i<22;$i++){
    ?>
 <div class="tile rounded shadow-sm border" data-background="tile<?=$i?>.png" style="background-image:url(./assets/images/tiles/tile<?=$i?>.png)"></div>
    <?php
}
            ?>

  <div class="tile rounded shadow-sm border" data-background="tile23.jpg" style="background-image:url(./assets/images/tiles/tile23.jpg)"></div>

</div>
  </div>
</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Font</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
 <select class="form-control" id="font">
    <option value='oo' <?=$resume['font']=='oo'?'selected':''?>>System Font</option>
    <option value="'Poppins', sans-serif" style="font-family:'Poppins', sans-serif" <?=$resume['font']=="'Poppins', sans-serif"?'selected':''?>>'Poppins', sans-serif</option>
    <option value="'Caveat', cursive" style="font-family:'Caveat', cursive" <?=$resume['font']=="'Caveat', cursive"?'selected':''?>>'Caveat', cursive</option>
    <option value="'Dancing Script', cursive" style="font-family:'Dancing Script', cursive" <?=$resume['font']=="'Dancing Script', cursive"?'selected':''?>>'Dancing Script', cursive</option>
    <option value="'Exo', sans-serif" style="font-family:'Exo', sans-serif" <?=$resume['font']=="'Exo', sans-serif"?'selected':''?>>'Exo', sans-serif</option>
    <option value="'Fuggles', cursive" style="font-family:'Fuggles', cursive" <?=$resume['font']=="'Fuggles', cursive"?'selected':''?>>'Fuggles', cursive</option>
    <option value="'Gloria Hallelujah', cursive" style="font-family:'Gloria Hallelujah', cursive" <?=$resume['font']=="'Gloria Hallelujah"?'selected':''?>>'Gloria Hallelujah', cursive</option>
    <option value="'Mooli', sans-serif" style="font-family:'Mooli', sans-serif" <?=$resume['font']=="'Mooli', sans-serif"?'selected':''?>>'Mooli', sans-serif</option>
    <option value="'Nunito', sans-serif" style="font-family:'Nunito', sans-serif" <?=$resume['font']=="'Nunito', sans-serif"?'selected':''?>>'Nunito', sans-serif</option>
    <option value="'Zilla Slab', serif" style="font-family:'Zilla Slab', serif" <?=$resume['font']=="'Zilla Slab', serif"?'selected':''?>>'Zilla Slab', serif</option>
 </select>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script>

$("#downloadpdf").click(function(){
    window.jsPDF = window.jspdf.jsPDF
    var doc = new jsPDF();

    var page = document.querySelector('.page');

    doc.html(page,{
callback: function(doc){
doc.save('<?=$resume['full_name']?> - <?=$resume['resume_title']?>.pdf');
},
margin:[2,2,2,2],
x:0,
y:0,
width:200,
windowWidth:800
    });
})

$("#font").change(function(){
  
    let font = $(this).find(":selected").val();
    $(".page").css('font-family',font);

    $.ajax({
        url:'actions/changefont.action.php',
        method:'post',
        data:{
            resume_id: <?=@$resume['id']?> ,
            font : font
        },
        success:function(res){
console.log(res);
        },
        error:function(res){
            console.log(res);
            alert('font is not updated');
        }
    })

})

$(".tile").click(function(){
  
    let tile = $(this).data('background');;

    $("body").css('background-image','url(./assets/images/tiles/'+tile+')');

    $.ajax({
        url:'actions/changeback.action.php',
        method:'post',
        data:{
            resume_id: <?=@$resume['id']?> ,
            background : tile
        },
        success:function(res){
console.log(res);
        },
        error:function(res){
            console.log(res);
            alert('background is not updated');
        }
    })

})

$("#print").click(function(){
   $(".extra").hide();

   window.print();

   setTimeout(() => {
      $(".extra").show();
   }, 500);
 
})


</script>
</body>
</html>