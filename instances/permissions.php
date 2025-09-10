<div class="permission-section">
            <h3 class="permission-header">WebAdmin jogosultságok <span class="toggle-icon">+</span></h3>
            <div class="permission-content" style="display: none;">
                <div class="permission-item">
                    <input type="checkbox" id="perm0" name="permissions[]" value="view_webadmin" <?=in_array("view_webadmin", $perms) ? "checked" : ""?>>
                    <label for="perm0">Webadmin használata</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm1" name="permissions[]" value="view_posts" <?=in_array("view_posts", $perms) ? "checked" : ""?>>
                    <label for="perm1">Összes bejegyzés megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm2" name="permissions[]" value="create_post" <?=in_array("create_post", $perms) ? "checked" : ""?>>
                    <label for="perm2">Új bejegyzés létrehozása</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm3" name="permissions[]" value="create_news" <?=in_array("create_news", $perms) ? "checked" : ""?>>
                    <label for="perm3">Új hír közzététele</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm4" name="permissions[]" value="view_all_users" <?=in_array("view_all_users", $perms) ? "checked" : ""?>>
                    <label for="perm4">Összes felhasználó megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm5" name="permissions[]" value="register_user" <?=in_array("register_user", $perms) ? "checked" : ""?>>
                    <label for="perm5">Felhasználó regisztrálása</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm6" name="permissions[]" value="edit_user" <?=in_array("edit_user", $perms) ? "checked" : ""?>>
                    <label for="perm6">Felhasználó kezelése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm7" name="permissions[]" value="ban_user" <?=in_array("ban_user", $perms) ? "checked" : ""?>>
                    <label for="perm7">Felhasználó kitíltása</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm8" name="permissions[]" value="deshow_user" <?=in_array("deshow_user", $perms) ? "checked" : ""?>>
                    <label for="perm8">Felhasználó elrejtése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm9" name="permissions[]" value="view_badges" <?=in_array("view_badges", $perms) ? "checked" : ""?>>
                    <label for="perm9">Rangok megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm10" name="permissions[]" value="create_badge" <?=in_array("create_badge", $perms) ? "checked" : ""?>>
                    <label for="perm10">Rang létrehozása</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm11" name="permissions[]" value="edit_badge" <?=in_array("edit_badge", $perms) ? "checked" : ""?>>
                    <label for="perm11">Rang szerkesztése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm12" name="permissions[]" value="log_center" <?=in_array("log_center", $perms) ? "checked" : ""?>>
                    <label for="perm12">Log-Center megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm13" name="permissions[]" value="files" <?=in_array("files", $perms) ? "checked" : ""?>>
                    <label for="perm13">Fájlok megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm14" name="permissions[]" value="stats" <?=in_array("stats", $perms) ? "checked" : ""?>>
                    <label for="perm14">Oldal statisztika megtekintése</label>
                </div>
            </div>
            
            <h3 class="permission-header">Felhasználó jogosultságok <span class="toggle-icon">+</span></h3>
            <div class="permission-content" style="display: none;">
                <div class="permission-item">
                    <input type="checkbox" id="perm15" name="permissions[]" value="edit_username" <?=in_array("edit_username", $perms) ? "checked" : ""?>>
                    <label for="perm15">Felhasználónév szerkesztése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm16" name="permissions[]" value="view_email" <?=in_array("view_email", $perms) ? "checked" : ""?>>
                    <label for="perm16">Email megtekintése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm17" name="permissions[]" value="edit_email" <?=in_array("edit_email", $perms) ? "checked" : ""?>>
                    <label for="perm17">Email szerkesztése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm18" name="permissions[]" value="change_password" <?=in_array("change_password", $perms) ? "checked" : ""?>>
                    <label for="perm18">Jelszó változtatás</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm19" name="permissions[]" value="edit_description" <?=in_array("edit_description", $perms) ? "checked" : ""?>>
                    <label for="perm19">Leírás szerkesztése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm20" name="permissions[]" value="deshow_avatar" <?=in_array("deshow_avatar", $perms) ? "checked" : ""?>>
                    <label for="perm20">Profilkép elrejtése</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm21" name="permissions[]" value="change_badges" <?=in_array("change_badges", $perms) ? "checked" : ""?>>
                    <label for="perm21">Rang kiválasztása</label>
                </div>
                <div class="permission-item">
                    <input type="checkbox" id="perm22" name="permissions[]" value="view_discord_status" <?=in_array("view_discord_status", $perms) ? "checked" : ""?>>
                    <label for="perm22">Discord státusz megtekintése</label>
                </div>
            </div>
</div>