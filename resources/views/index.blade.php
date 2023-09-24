<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question and Answer</title>
    <!-- Add Bootstrap CSS (you can link to a hosted version or use a local file) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question:</h5>
                        <p class="card-text">{{$question->questions}}</p>
                            <div class="form-group">
                                <label for="answer">Your Answer:</label>
                                <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                            </div>
                           <a href="?id={{$question->id + 1}}"><button type="button" class="btn btn-primary" id="next">Next</button></a>
                            
                    </div>
                </div>
            </div>
            
        </div>
        <div class="mt-1" id="response"></div>
    </div>

    <!-- Add Bootstrap JS and jQuery (you can link to hosted versions or use local files) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    document.body.onkeyup = function(e) {
  if (e.key == " " ||
      e.code == "Space" ||      
      e.keyCode == 32      
  ) {
   // Creating Our XMLHttpRequest object
   let xhr = new XMLHttpRequest();
 
 // Making our connection 
 
 var prompt = document.getElementById("answer").value;
 var id = <?php echo $question->id ?>;

 let url = '/genrate?prompt=' + prompt + '&id=' + id ;
 xhr.open("GET", url, true);

 // function execute after request is successful
 xhr.onreadystatechange = function () {
     if (this.readyState == 4 && this.status == 200) {
         console.log(this.responseText);
         document.getElementById("response").innerHTML = this.responseText;
         document.getElementById("response").classList.add("alert");
         if(this.responseText === 'Good To Go!')
         {
         document.getElementById("response").classList.add("alert-success");
         }
         else
         {
         document.getElementById("response").classList.add("alert-danger");
         document.getElementById("next").classList.add("disabled");
         }
        
     }
 }
 // Sending our request
 xhr.send();
  }
}
</script>
</html>
