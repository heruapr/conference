<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="img/sentrin.webp" />

        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href=""><img src="img/sentrin.webp" height="50" width="150"></img></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><img src="img/icon-home.png" height="30" width="30" ></img><span class="sr-only">(current)</span></a>
      </li>
      
    &nbsp &nbsp &nbsp&nbsp
    <! DEADLINE ON NAVBAR -->
       <?php
          include 'fuseki.php';
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?paperdue conf:isPaperDue ?Conference.
  ?paperdue conf:name ?date.
  ?start conf:isStartDate ?Conference.
  ?start conf:name ?namastart.
  ?endDate conf:isEndDate ?Conference.
  ?endDate conf:name ?namaend.
  ?Conference conf:name ?confName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest(); 
          foreach ($result as $loop) {

               if($loop['confName']['value']=="Seminar Nasional Teknologi dan Rekayasa Informasi 2018"){
              echo "<li> START DATE: <br>" . $loop['namastart']['value'] . "</li> &nbsp &nbsp "; 
               echo "<li> FULL PAPER DEADLINE: <br>" . $loop['date']['value'] . "</li> &nbsp &nbsp" ;
                echo "<li> END DATE: <br>" . $loop['namaend']['value'] . "</li>"; break;
              //echo "</tr>";
          } }
           ?>

            &nbsp &nbsp &nbsp&nbsp
    <! DEADLINE ON NAVBAR (PLACE) -->
       <?php
          
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?place conf:isPlaceOf ?Conference.
  ?place conf:name ?placeName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest(); 
          foreach ($result as $loop) {
            
              echo "<li> Host <br>" . $loop['placeName']['value'] . "</li>"; 
                break;
              //echo "</tr>";
          }
           ?>

            &nbsp &nbsp &nbsp&nbsp
    <! DEADLINE ON NAVBAR (INDEXER) -->
       <?php
          
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?index conf:isIndexerOf ?Conference.
  ?index conf:name ?indexer.
  ?Conference conf:name ?confName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest(); 
          foreach ($result as $loop) {
           if($loop['confName']['value']=="Seminar Nasional Teknologi dan Rekayasa Informasi 2018"){
              echo "<li> Indexer: <br>" . $loop['indexer']['value'] . "</li>"; 
                break;
              //echo "</tr>";
          }}
           ?>
    </ul>
   
  </div>
</nav>
   

    <title>SENTRIN</title>
  </head>
  <body>

    <!- INVITED SPEAKER -->
          <?php
          
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?Conference conf:hasInvitedSpeaker ?InvitedSpeaker.
  ?InvitedSpeaker conf:name ?namaSpeaker.
  ?Conference conf:name ?confName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest();
          echo '
          <div class="container">
          <h1>Invited Speaker</h1>
          <table class="table table-hover"
            <thead>
              <tr>
                
                <th scope="col">Conference</th>
                <th scope="col">Nama Speaker</th>
              </tr>
            </thead>
          <tbody>';
          foreach ($result as $loop) {
            

              echo '<tr class="table-success">';
              if($loop['confName']['value']=="Seminar Nasional Teknologi dan Rekayasa Informasi 2018"){
              echo "<td>" . $loop['confName']['value'] . "</td>";
              echo "<td>" . $loop['namaSpeaker']['value'] . "</td>"; }
              echo "</tr>";
          }
          echo '</tbody>
          </table>
          </div>

          ';
           ?>
           <br><br>


           <!- KEYNOTE SPEAKER -->

            <?php
          
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?Conference conf:hasKeynoteSpeaker ?KeynoteSpeaker.
  ?KeynoteSpeaker conf:name ?namaSpeaker.
  ?Conference conf:name ?confName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest();
          echo '
          <div class="container">
          <h1>Keynote Speaker</h1>
          <table class="table table-hover">
            <thead>
              <tr>
                
                <th scope="col">Conference</th>
                <th scope="col">Nama Speaker</th>
              </tr>
            </thead>
          <tbody>';
          foreach ($result as $loop) {
            

              echo '<tr class="table-success">';
              if($loop['confName']['value']=="Seminar Nasional Teknologi dan Rekayasa Informasi 2018"){
              echo "<td>" . $loop['confName']['value'] . "</td>";
              echo "<td>" . $loop['namaSpeaker']['value'] . "</td>";
              echo "</tr>"; }
          }
          echo '</tbody>
          </table>
          </div>

          ';
           ?> <br><br>

           <!-TOPIC  -->
            <?php
          
          $request = new Fuseki('http://localhost:3030', 'conferences');
          $sparql = "
          PREFIX family: <http://www.semanticweb.org/prasiman/family#>
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX owl: <http://www.w3.org/2002/07/owl#>
          PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
          PREFIX conf: <http://www.filkom.ub.ac.id/conferences#>

          SELECT *
WHERE {
  ?topic conf:isTopicOf ?Conference.
  ?topic conf:name ?topicName.
  ?Conference conf:name ?confName

}";
          $request->setSparQl($sparql);
          $nomor = 0;
          $result = $request->sendRequest();
          echo '
          <div class="container">
          <h1>Topic</h1>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Conference</th>
                <th scope="col">Topic</th>
                
              </tr>
            </thead>
          <tbody>';
          foreach ($result as $loop) {
            if($loop['confName']['value']=="Seminar Nasional Teknologi dan Rekayasa Informasi 2018"){

              echo '<tr class="table-success">';
              echo "<td>" . $loop['confName']['value'] . "</td>";
              echo "<td>" . $loop['topicName']['value'] . "</td>";
              
              echo "</tr>"; }
          }
          echo '</tbody>
          </table>
          </div>

          ';
           ?>
  </body>
    <!-- Footer -->
<footer class="page-footer font-small blue pt-3">

   
    <div class="footer-copyright text-center py-3">©
      FINALPROJECT WEB SEMANTIK
    </div>
    

  </footer>
  <!-- Footer -->
</html>
