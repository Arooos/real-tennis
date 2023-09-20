<?php
require "../app/connection/tennis_cnf.php";
    if(isset($_POST["tour_year"])){
    $sth = $db->prepare("SELECT * FROM `tournament` WHERE `year` = '".$_POST["tour_year"]."'");
    $sth->execute(array());
    $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach($cat_va as $cat_v){
?>
<div class="col-md-4 col-sm-6 col-12">
    <div class="modal_tour_item">
        <button data-modal="modal_history" class="modal_tour_item_btn bg_block view_data" id="<?php echo $cat_v["id"];?>"></button>
        <div class ="modal_tour_item_title">
        <?php
            $date = $db->prepare("SELECT DATE_FORMAT(`date`,'%m.%d') FROM `tournament` WHERE id=$cat_v[id]");
            $date->execute(array());
            $date_tour = $date->fetch(PDO::FETCH_COLUMN);
            echo $date_tour;
        ?>
        </div>
    </div>
</div>

<div class="modal modal_history" id="modal_history">
            <div class="modal_history_close">&times;</div>
            <div class="container">
                <div class="row" id="employee_detail">
                </div>
            </div>
        </div>


<?php }}?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
     $(document).ready(function(){ 
        $('[data-modal=modal_history]').on('click', function(){
            var tournament_id = $(this).attr("id");
             $.ajax({
                  url:"../form/modal_tour.php",
                  method:"post",
                  data:{tournament_id:tournament_id}, 
                  success:function(data){  
                    $('#employee_detail').html(data); 
                    $('#modal_history').fadeIn('o.5s');
                  }
             });
        });
    });

</script>
