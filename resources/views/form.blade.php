<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>SMS Sender</title>
</head>
<body>
    <div class="container">
        <form class="mt-4" method="POST">
            <h4 class="text-center">Send sms</h4>
            @if (isset($msg))
                <div class="alert alert-success" role="alert">
                    {{$msg}}
                </div>
            @endif
            <div class="form-group">
              <label>Phone number</label>
              <input name="phone" type="number" class="form-control" aria-describedby="emailHelp" placeholder="Enter phone">
              <small id="emailHelp" class="form-text text-muted">Format: 77xxxxxxxxx.</small>
            </div>
            <div class="form-group">
              <label>Text</label>
              <textarea name="text" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>