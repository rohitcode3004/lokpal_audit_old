<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 10/4/2018
 * Time: 3:12 PM
 */
/*
if(isset($_REQUEST['filing_no']) && $_REQUEST['filing_no'] != ''){
$string = $_REQUEST['filing_no'];
$name_attribute = 'filing_no';
}

elseif(isset($_REQUEST['filing_n']) && $_REQUEST['filing_n'] != ''){
$string = $_REQUEST['filing_n'];
$name_attribute = 'filing_n';
}


elseif(isset($_REQUEST['obj_name']) && $_REQUEST['obj_name'] != ''){
$string = $_REQUEST['obj_name'];
$name_attribute = 'obj_name';
}

elseif(isset($_REQUEST['appfiling_n']) && $_REQUEST['appfiling_n'] != ''){
$string = $_REQUEST['appfiling_n'];
$name_attribute = 'appfiling_n';
}

else{
$string = '';
$name_attribute = '';
}


function removeSpecialChar($string,$name_attribute){
$string = preg_replace('/[^a-zA-Z0-9\/]/', '', $string);
$_REQUEST[$name_attribute] = $string;
}
if(isset($string) && $string != '' && isset($name_attribute) && $name_attribute != ''){
	removeSpecialChar($string,$name_attribute);
}

if(($_SESSION[user]=='')&& $_SESSION[location]==''){
    header('Location: '.SITE_URL.$currentDir.'/index.php');
    die();
}
$urlll = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
$url_var = explode('/' , $urlll);
*/
?>

<style>

    #topa{padding-top: 0px;
        padding-bottom: 0px;}
</style>

<script>
<?php if(basename($_SERVER[SCRIPT_FILENAME])!='filing.php'){?>
    $(document).ready(function() {
        $('form').attr('autocomplete', 'off');
        $("form").each(function() {
            var tokenElement = jQuery(document.createElement('input'));
            tokenElement.attr('type', 'hidden');
            tokenElement.attr('name', 'csrf_token');
            tokenElement.attr('id', 'csrf_token');
            tokenElement.val('<?php echo $_SESSION['csrf_token']= md5(uniqid(rand(), TRUE));?>');
            jQuery(this).append(tokenElement);
        });
    });
<?php }?>

</script>


<div class="row top-black-line">
</div>
<div class="container" >
    <div class="row">
        <div class="col-md-8">
            <div class="media title-padding">
                <img src="<?php echo base_url();?>assets/images/indian-emblem.png" style="float: left;    margin-top: 20px;">
                <div class="media-body title-pad-left">
                    <blockquote class="blockquote ">

                        <h1 style="font-size: 32px;">Real Estate Appellate Tribunal</h1>
                        <footer class="blockquote-footer">
                            <cite title="Source Title"><?php //echo $short_name?></cite>
                        </footer>
                    </blockquote>
                </div>
            </div>


        </div>
        <div class="col-md-4 d-none d-sm-none d-md-block" id="dig_img">
            <img src="<?php echo base_url();?>assets/images/digital-india.png" class="img-fluid float-right dig-img-pad" alt="Digital India">
        </div>
    </div>
</div>





<header id="main-menu-container" class="">
    <nav class="navbar navbar-inverse main-menu navbar-inverse-bg" id="skip">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse"
                        data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse js-navbar-collapse" id="Divmenu">

<?php if($_SESSION[localadmin]==0){?>
<ul class="nav navbar-nav">

    <li><a href="#" style="color: #fff; background: #337ab7;"><i class="fa fa-home" style="font-size: 17px;"></i></a></li>
    <li><a href="<?php echo base_url();?>/e-filing/filing.php">Appeal Filing</a></li>
    <li><a href="<?php echo base_url();?>/e-filing/docufile.php">Document Filing</a></li>
    <li><a href="<?php echo base_url();?>/users/logout.php">Logout</a></li>
</ul>
<?php
}
else
{
    ?>

 <ul class="nav navbar-nav" >

<?php
/*
//
$sessionUserType = $_SESSION[sessionUserType];
//$sessionUserType = '30,3,4,9,16,10,14,8,17,15,11,27,2,7,26,1,20,22,23,24';

$sth = $db->prepare("select *  from sidemenu where display='TRUE'");
$sth->execute();
$rrr= $sth->fetchAll();

$pieces=explode(',',$sessionUserType);
for($c=0;$c<count($pieces);$c++) {
    $sql = "select * from sidemenu where module_cd=$pieces[$c] and display='TRUE'  order by priority asc";
    $sth = $db->prepare($sql);
    $sth->execute();
    if($sth->rowCount()>0)
    {
    $row = $sth->fetch();
        $module_name =$row['module_name'];
        $sidemenu_name =$row['sidemenu_name'];
        $module_code =$row['module_cd'];
        ?>
        <li class="dropdown men "><a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $sidemenu_name ;?> <b class="caret"></b></a>

                <?php
                $sql="select link_cd ,link_name from links where module_cd=$module_code and display='Y' order by priority asc";
                $sth = $db->prepare($sql);
                $sth->execute();
                if($sth->rowCount()>0)
                {
                ?>
                <ul class="dropdown-menu">
                <?php
                while($row = $sth->fetch())
                {
                    $i=$row['link_cd'];
                    $link_name=$row['link_name'];
                ?>
                <li class="dropdown-submenu men "><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $link_name;?></a>
                    <?php
                    $sqlq="select sublink_name ,sublink_filename from sub_links where module_cd=$module_code and link_cd=$i and  display='Y'  order by priority asc";
                    $ss = $db->prepare($sqlq);
                    $ss->execute();

                    if($ss->rowCount()>0){
                    ?>
                    <ul class="dropdown-menu">
                       <?php
                        foreach($db->query($sqlq) as $row1)
                        {
                        $sublink_name =$row1['sublink_name'];
                        $sublink_filename =$row1['sublink_filename'];
                        ?>
                        <li class="men"><a href="../<?php echo $module_name ;?>/<?php echo $sublink_filename;?>"><?php echo $sublink_name;?></a></li>
                        <?php
                      }
                        ?>

                    </ul>
                        <?php } ?>
                </li>
                <?php }?>

            </ul>
            <?php }?>
        </li>

    <?php }?>

    <?php

}*/
?>
     <li><a href="<?php echo base_url();?>/users/logout.php">Logout</a></li>



                    </ul>

                <?php } ?>

<!--                    <ul class="nav navbar-nav" >-->
<!--                        <li><a href="#" style="color: #fff; background: #337ab7;"><i class="fa fa-home" style="font-size: 17px;"></i></a></li>-->
<!--                        <li class="dropdown men "><a href="" class="dropdown-toggle" data-toggle="dropdown">Test 1<b class="caret"></b></a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li class="dropdown-submenu men "><a href="" class="dropdown-toggle" data-toggle="dropdown">Test 1.1</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li class="dropdown-submenu men "><a href="" class="dropdown-toggle" data-toggle="dropdown">Test 1.1.1</a>-->
<!--                                        </li><li class="dropdown-submenu men "><a href="" class="dropdown-toggle" data-toggle="dropdown">Test 1.1.2</a>-->
<!--                                            <ul class="dropdown-menu">-->
<!--                                                <li class="men"><a href="">Test 1.1.1.1</a></li>-->
<!--                                                <li class="men"><a href="">Test 1.1.1.2</a></li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li class="men"><a href="">Test 1.2</a></li>-->
<!--                                <li class="men"><a href="/">Test 1.3</a></li>-->
<!--                                <li class="men"><a href="">Test 1.4</a></li>-->
<!--                                <li><a href="../logout1.php">Logout</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->





            </div>



            <!-- /.nav-collapse -->
        </div>
    </nav>
</header>