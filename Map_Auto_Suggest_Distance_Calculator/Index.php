<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    </head>
    <body>
		
		<form action="" method="post">

            <label>Origin:</label><select id="address" name="o" style="width:500px;"></select><br><br>
            <label>Destination:</label><select id="address1" name="d" style="width:500px;"></select><br><br>
            <input type="submit" value="Calculate distance & time" name="submit"> <br><br>

        </form>
		
        <script type="text/javascript">
            $(document).ready(function(){

                $("#submit").click(function(){
                    var val = $("#address").val();
                    alert(val);
                });

                $('select').select2({
                    placeholder: "Search for your city",
                    ajax: {
                        url: function(params){
                            return 'api.php?data='+params.term; 
                        },
                        dataType: 'json', 
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.text,
                                        id: item.text
                                    }
                                })
                            };
                        }
                    }

                });
            });
        </script>
		<?php
            if(isset($_POST['submit'])){
				$arrContextOptions=array(
						"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);  
				$origin = str_replace(" ", "%20",$_POST['o']); $destination = str_replace(" ", "%20",$_POST['d']);
				$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=AIzaSyAfJA2iibIYzn6wQvQckp7gxXT_l9TWKg8",false,stream_context_create($arrContextOptions));
				$data = json_decode($api);
        ?>
            <label><b>Distance: </b></label> <span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span> <br><br>
            <label><b>Travel Time: </b></label> <span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span> 

        <?php } ?>
    </body>
</html>