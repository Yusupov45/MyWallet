<?php
require_once "../core/header.php";
?>

<div class="form">
    <h1>Личный кабинет</h1>
    <img src="<?= $profile['avatar']?>"> <br>
    Баланс <?php echo $profile['money']."$"?> <br>
    Номер счета №<?php echo $profile['number_check']?> <br>

    <h3>Перевод</h3>
    <form action="" method="post" >
        <input type="hidden" name="id_form" value="transaction">
        <label>
            Номер счета:
            <input type="text" name="recipient" class="input">
        </label>

        <label>
            Сумма:
            <input type="text" name="sum" class="input">
        </label>

        <input type="submit" value="Отправить" class="input submit">
    </form>

    <?php
    if ($requestResult['status'] === false) {
        echo "<div class='error-massage'>".$requestResult['message']."</div>";
    }
    elseif ($requestResult['status'] === true) {
        echo "<div class='success'>".$requestResult['message']."</div>";
    }
    ?>
</div>

