<?php
if (isset($page[1])){
    $id = $page[1]; 
}else{
    $id = -1;
}
$account_data = getAccountData($id);
?>

<div class="form-wrapper">
  <div class="form-panel">
    <h2>Felhasználó szerkesztése</h2>
    <form method="POST">
      <div class="form-group">
        <label for="name">Felhasználónév*</label>
        <input type="text" id="name" name="name" placeholder="Pl. kisspista48" value="<?=$account_data["username"]?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email cím*</label>
        <input type="email" id="email" name="email" placeholder="Pl. kiss.pista@pelda.hu" value="<?=$account_data["email"]?>" required>
      </div>
      <div class="form-group">
        <label for="fullname">Teljes név</label>
        <input type="text" id="fullname" name="fullname" placeholder="Pl. Kiss Pista" value="<?=$account_data["fullname"]?>">
      </div>
      <div class="form-group">
        <label for="status">Státusz</label>
        <select name="status" id="status">
          <option value="0" <?= $account_data["status"] == 0 ? "selected" : "" ?>>0 - Email megerősítésre vár</option>
          <option value="1" <?= $account_data["status"] == 1 ? "selected" : "" ?>>1 - Email megerősítve</option>
          <option value="2" <?= $account_data["status"] == 2 ? "selected" : "" ?>>2 - Deaktiválva</option>
      </select>
      </div>
      <button type="submit" name="editUser" class="btn btn-primary">Mentés</button>
      <?php
        if (isset($_POST["editUser"])) {
            $result = editUser($_POST,$id);
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