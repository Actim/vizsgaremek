<table id="allAccounts">
    <thead>
        <tr>
            <th>#</th>
            <th>Felhasználónév</th>
            <th>Teljes név</th>
            <th>Email</th>
            <th>Legutóbbi bejelentkezés</th>
            <th>Legutóbbi IP cím</th>
            <th>Legutóbbi SESSION id</th>
            <th>Regisztráció dátuma</th>
            <th>Kezelés</th>
        </tr>
    </thead>
    <tbody>
        <?=getAllAccounts()?>
    </tbody>
</table>

<!-- Overlay -->
<div class="modal-overlay" id="modalOverlay"></div>

<!-- Login modal -->
<div class="modal" id="myModal">
  <div class="modal-header">
    <h2>Legutóbbi 10 bejelentkezés</h2>
    <span class="close-btn" id="closeModalBtn">&times;</span>
  </div>
  <div class="modal-body" id="modalContent"></div>
  <div class="modal-footer">
    <button class="btn btn-danger ripple" id="closeFooterBtn">Bezárás</button>
  </div>
</div>

<!-- Views modal -->
<div class="modal" id="viewsModal">
  <div class="modal-header">
    <h2>Legutóbbi 10 megtekintései</h2>
    <span class="close-btn" id="closeViewsModalBtn">&times;</span>
  </div>
  <div class="modal-body" id="viewsModalContent"></div>
  <div class="modal-footer">
    <button class="btn btn-danger ripple" id="closeViewsFooterBtn">Bezárás</button>
  </div>
</div>

<!-- Suspend Modal -->
<div class="modal" id="suspendModal">
  <div class="modal-header">
    <h2>Felhasználó felfüggesztése</h2>
    <span class="close-btn" id="closeSuspendModalBtn">&times;</span>
  </div>
  <div class="modal-body">
    <form id="suspendForm">
      <input type="hidden" id="suspendUserId" name="userId">
      <div class="form-group">
        <label for="suspendReason">Indok:</label>
        <textarea id="suspendReason" name="reason" rows="4" placeholder="Írd ide az indokot..." required></textarea>
      </div>
      <button type="submit" class="btn btn-danger">Mentés</button>
    </form>
  </div>
</div>

<script src="assets/js/allAccounts.js"></script>


