<?php

class Models {
    function showEmployees() {
        $pdo = new PDO('mysql:host=localhost;dbname=bugSniffer', 'root', 'mysql');
        $sql = "SELECT id, name FROM employees";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach($users as $user):
        ?>
            <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
        <?php
        endforeach;
    }

    function showStatus() {
        $statusArr = array("Open", "Closed", "Pending");
        foreach($statusArr as $status):
        ?>
            <option value="<?= $status; ?>"><?= $status; ?></option>
        <?php
        endforeach;
    }

    function showType() {
        $statusArr = array("Exploit", "Runtime", "Logical", "Other");
        foreach($statusArr as $status):
        ?>
            <option value="<?= $status; ?>"><?= $status; ?></option>
        <?php
        endforeach;
    }

    function showPriority() {
        $statusArr = array("Low", "Medium", "High");
        foreach($statusArr as $status):
        ?>
            <option value="<?= $status; ?>"><?= $status; ?></option>
        <?php
        endforeach;
    }
}

// possibly check for not closing PDO correctly
?>



