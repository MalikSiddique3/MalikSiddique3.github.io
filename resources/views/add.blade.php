@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add  Question</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Add Question</h1>
        <form action="{{url('store')}}" method="POST">
            @csrf
            <!-- Hidden input for question ID (assuming you are editing an existing question) -->
            <input type="hidden" name="question_id" value="1">

            <div class="form-group">
                <label for="question">Question:</label>
                <textarea class="form-control" name="question" id="question" rows="4" cols="50"></textarea>
            </div>

          

           

            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@endsection