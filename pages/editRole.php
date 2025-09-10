<?php
if (isset($page[1])){
    $id = $page[1]; 
}else{
    $id = -1;
}
$role_data = getRoleData($id);
$perms = json_decode($role_data["perms"]) ?? array();
?>

<div class="form-wrapper">
  <div class="form-panel">
    <h2>Jogosultság létrehozás</h2>
    <form method="POST">
      <div class="form-group">
        <label for="name">Jogosultság megnevezése*</label>
        <input type="text" id="name" name="name" placeholder="Írd be a jogosultság nevét" value="<?=$role_data["name"]?>" required>
      </div>
      <div class="form-group">
        <label for="piority">Pioritás*</label>
        <input type="number" id="piority" name="piority" placeholder="Pl. 120" value="<?=$role_data["piority"]?>" required>
      </div>
      <div class="form-group">
        <label for="css">CSS</label>
        <textarea id="css" name="css" rows="6" placeholder="Amilyen dizájnt szeretnél látni!"><?=$role_data["css"]?></textarea>
      </div>
      <?php require_once("instances/permissions.php"); ?>
      <button type="submit" name="editRole" class="btn btn-primary">Létrehozás</button>
      <?php
        if (isset($_POST["editRole"])) {
            $result = editRole($_POST,$id);
            if (!$result["success"]) {
                echo "<p class='error'>" . htmlspecialchars($result["message"]) . "</p>";
            }
        }
        ?>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.permission-header').forEach(header => {
    header.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const icon = this.querySelector('.toggle-icon');
        
        if (content.style.display === 'none') {
            content.style.display = 'block';
            icon.textContent = '-';
        } else {
            content.style.display = 'none';
            icon.textContent = '+';
        }
    });
});
</script>