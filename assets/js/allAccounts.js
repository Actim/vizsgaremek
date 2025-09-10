document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("modalOverlay");

    // -------------------
    // LOGIN MODAL
    // -------------------
    const loginModal = document.getElementById("myModal");
    const loginContent = document.getElementById("modalContent");
    const closeLoginBtns = [
        document.getElementById("closeModalBtn"),
        document.getElementById("closeFooterBtn")
    ];
    document.querySelectorAll(".openModalLink").forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault();
            const userId = link.dataset.userid;
            const contentDiv = document.getElementById(`modalUser${userId}`);
            loginContent.innerHTML = contentDiv.innerHTML;
            loginModal.style.display = "block";
            overlay.style.display = "block";
        });
    });
    closeLoginBtns.forEach(btn => btn.addEventListener("click", () => {
        loginModal.style.display = "none";
        overlay.style.display = "none";
        loginContent.innerHTML = "";
    }));

    // -------------------
    // VIEWS MODAL
    // -------------------
    const viewsModal = document.getElementById("viewsModal");
    const viewsContent = document.getElementById("viewsModalContent");
    const closeViewsBtns = [
        document.getElementById("closeViewsModalBtn"),
        document.getElementById("closeViewsFooterBtn")
    ];
    document.querySelectorAll(".openViewsModalLink").forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault();
            const userId = link.dataset.userid;
            const contentDiv = document.getElementById(`viewsModalUser${userId}`);
            viewsContent.innerHTML = contentDiv.innerHTML;
            viewsModal.style.display = "block";
            overlay.style.display = "block";
        });
    });
    closeViewsBtns.forEach(btn => btn.addEventListener("click", () => {
        viewsModal.style.display = "none";
        overlay.style.display = "none";
        viewsContent.innerHTML = "";
    }));

    // -------------------
    // SUSPEND / UNBAN
    // -------------------
    const suspendModal = document.getElementById("suspendModal");
    const suspendForm = document.getElementById("suspendForm");
    const suspendUserIdInput = document.getElementById("suspendUserId");
    const suspendReasonInput = document.getElementById("suspendReason");
    const closeSuspendModalBtn = document.getElementById("closeSuspendModalBtn");

    document.querySelectorAll(".suspendBtn").forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            const userId = btn.dataset.userid;
            const isBan = btn.textContent.includes("Kitíltás");

            if (isBan) {
                // Kitíltás → modal nyitása
                suspendUserIdInput.value = userId;
                suspendModal.style.display = "block";
                overlay.style.display = "block";
            } else {
                // Feloldás → AJAX
                fetch('ajax/suspendUser.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=unbanUser&userId=${encodeURIComponent(userId)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        btn.innerHTML = `<i class='fa-solid fa-ban'></i> Kitíltás`;
                        alert("Feloldva!");
                    } else {
                        alert(data.message || "Hiba történt a feloldás során!");
                    }
                })
                .catch(err => console.error(err));
            }
        });
    });

    closeSuspendModalBtn.addEventListener("click", () => {
        suspendModal.style.display = "none";
        overlay.style.display = "none";
        suspendForm.reset();
    });

    suspendForm.addEventListener("submit", e => {
        e.preventDefault();
        const userId = suspendUserIdInput.value;
        const reason = suspendReasonInput.value;

        fetch('ajax/suspendUser.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `action=banUser&userId=${encodeURIComponent(userId)}&reason=${encodeURIComponent(reason)}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const btn = document.querySelector(`.suspendBtn[data-userid='${userId}']`);
                if (btn) btn.innerHTML = `<i class='fa-solid fa-ban'></i> Feloldás`;
                suspendModal.style.display = "none";
                overlay.style.display = "none";
                suspendForm.reset();
                alert("Felhasználó kitíltva!");
            } else {
                alert(data.message || "Hiba történt a kitíltás során!");
            }
        })
        .catch(err => console.error(err));
    });



    // -------------------
    // Overlay kattintás minden modalhoz
    // -------------------
    overlay.addEventListener("click", () => {
        loginModal.style.display = "none";
        viewsModal.style.display = "none";
        suspendModal.style.display = "none";
        editModal.style.display = "none";
        overlay.style.display = "none";

        loginContent.innerHTML = "";
        viewsContent.innerHTML = "";
        suspendForm.reset();
        editForm.reset();
    });
});
