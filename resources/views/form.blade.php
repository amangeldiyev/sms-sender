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
        <h4 class="text-center mt-4">Send sms</h4>
        @if (isset($message_id))
            <div class="alert alert-success" role="alert">
                SMS sent successfully! Message ID: {{$message_id}}
                <u style="cursor: pointer" onclick="checkStatus('{{$message_id}}')" class="float-right">Check status</u>
            </div>
        @endif

        @if (isset($error))
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endif
        <form class="mt-4" method="POST">

            <div class="form-group">
              <label>Phone number</label>
              <input name="phone" type="number" class="form-control" placeholder="Enter phone">
              <small id="emailHelp" class="form-text text-muted">Format: 77xxxxxxxxx.</small>
            </div>
            <div class="form-group">
              <label>Text</label>
              <textarea name="text" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

        <hr>
        <h4>Check Status</h4>
        <div class="form-group">
            <label>Message ID</label>
            <input type="text" id="message_id" class="form-control" placeholder="Message ID">
        </div>
        <button onclick="checkStatus(document.getElementById('message_id').value)" class="btn btn-primary">Check</button>

        <hr>
        <p class="text-primary" id="message_status"></p>
    </div>

    <script>
        function checkStatus(message_id) {
            fetch('/status/' + message_id)
            .then(response => response.json())
            .then(data => {
                
                var text = message_id + ': ' + data.status

                if(data.error) {
                    text = text + ' (' + data.error + ')'
                }
                
                document.getElementById('message_status').innerText = text
            });
        }
    </script>
</body>
</html>