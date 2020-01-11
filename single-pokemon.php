<!DOCTYPE html>
<html>
<head>
<style>
h1 {
    text-transform: CAPITALIZE;
}
.grid-container {
  display: grid;
  grid-gap: 50px 100px;
  grid-template-columns: auto auto;
  background-color: #2196F3;
  padding: 10px;
}

.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
</style>
</head>
<body>
<?php
if(isset($_GET['id']) && $_GET['id']!= ""){
    $id = $_GET['id'];
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,"https://pokeapi.co/api/v2/pokemon/$id");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
    $poke_data = array();
    $single_data = json_decode($output);
    $poke_data['img'] = $single_data->sprites->front_default; 
    $poke_data['name'] = $single_data->name;
    $poke_data['height'] = $single_data->height;
    $poke_data['weight'] = $single_data->weight;
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,"https://pokeapi.co/api/v2/pokemon-species/$id");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $sp_opt=curl_exec($ch);
    curl_close($ch);
    $sp_opt = json_decode($sp_opt);
    foreach($sp_opt->flavor_text_entries as $key => $value){
        if($value->language->name=='en'){
            $poke_data['desc'] =  $value->flavor_text;
            break;
        }
    }
}

?>


<h1><?php echo $poke_data['name'];?></h1>

<div class="grid-container">
  <div class="grid-item"><img src="<?php echo $poke_data['img']; ?>"></img></div>
  <div class="grid-item"><?php echo $poke_data['desc'];?></div>
</div>
<div class="grid-container">
  <div class="grid-item">Weight: <?php echo $poke_data['weight']; ?></div>
  <div class="grid-item">Height: <?php echo $poke_data['height'];?></div>
</div>



</body>
</html>
