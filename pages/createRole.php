<div class="form-wrapper">
  <div class="form-panel">
    <h2>Jogosultság létrehozás</h2>
    <form method="POST">
      <div class="form-group">
        <label for="name">Jogosultság megnevezése*</label>
        <input type="text" id="name" name="name" placeholder="Írd be a jogosultság nevét" required>
      </div>
      <div class="form-group">
        <label for="piority">Pioritás*</label>
        <input type="number" id="piority" name="piority" placeholder="Pl. 120" required>
      </div>
      <div class="form-group">
        <label for="css">CSS</label>
        <textarea id="css" name="css" rows="6" placeholder="Amilyen dizájnt szeretnél látni!"></textarea>
      </div>
      <button type="submit" name="createRole" class="btn btn-primary">Létrehozás</button>
      <?php
        if (isset($_POST["createRole"])) {
            $result = createRole($_POST);
            if (!$result["success"]) {
                echo "<p class='error'>" . htmlspecialchars($result["message"]) . "</p>";
            }
        }
        ?>
    </form>
  </div>
</div>
