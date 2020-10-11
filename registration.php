<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <style>
        @import "css/style.css";
    </style>
</head>
<div class="central_form">
    <form action="regValidation.php" method="post">
        Nickname: <input type="text" name="username" placeholder="Enter your nickname" required>
        Password: <input type="password" name="password" placeholder="Enter your password" required>
        <br>
        <br>
        Enter your date of birth:
        <select name="day_of_birth" required>
            <option value="">Day</option>
            <?php
            $days = range(1, 31);
            foreach ($days as $day) {
                ?>
                <option value="<?= $day ?>"><?= $day ?></option>
                <?php
            }
            ?>
        </select>
        <select name="month_of_birth" required>
            <option value="">Month</option>
            <?php
            $months = range(1, 12);
            foreach ($months as $month) {
                ?>
                <option value="<?= $month ?>"><?= date("F", (strtotime("0000-$month-01"))) ?></option>
                <?php
            }
            ?>
        </select>
        <select name="year_of_birth" required>
            <option value="">Year</option>
            <?php
            $years = range(1800, date('Y'));
            foreach ($years as $year) { ?>
                <option value="<?= $year ?>"><?= $year ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <input class="button" type="submit" name="register" value="Register">
    </form>
</div>
</body>
</html>




