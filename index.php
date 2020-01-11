<!DOCTYPE html>
<html>
    <head>
        <title>Pokemon Data</title>
        <style>
        .grid-container {
          display: grid;
          grid-column-gap: 20px;
          grid-template-columns: auto auto auto;
          background-color: #2196F3;
          padding: 10px;
          row-gap: 20px;
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
        <h1>All Pokemon Data:</h1>
        <div class="grid-container">
            <?php 
            $ch = curl_init();  
            curl_setopt($ch,CURLOPT_URL,"https://pokeapi.co/api/v2/pokemon");
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $output=curl_exec($ch);
            curl_close($ch);
            $poke_data = json_decode($output);
            foreach($poke_data as $key=>$value){
                foreach($value as $k=>$v){
                    $parts = explode("/", $v->url);
                    ?>
                    <div class="grid-item"><a href="single-pokemon.php?id=<?php echo $parts['6']; ?>"><img class="img-name" src="images/images.jpg"></img></br><?php echo $v->name;?></a></div>
                    <?php
                }
            }
        ?> 
          
        </div>
    </body>
</html>
