<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="submit_form.php" method="POST" enctype="multipart/form-data" autocomplete="">
                    <h2 class="text-center">Submit Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="mobile" maxlength="10" placeholder="Mobile Number" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="message" placeholder="Message">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" name="file" accept=".jpeg, .jpg" required>
                        <label for="file">Upload Image (JPEG, Max: 500KB):</label>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
