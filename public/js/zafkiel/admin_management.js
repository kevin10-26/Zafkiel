'use strict';

const openAdminStatusModal = async (modalId) => {

    let getAdmins = await authManager.makeAuthenticatedRequest('./admin/fetchAdminDetails',
        {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            }
        }
    );

    let adminsRender = await getAdmins.text();

    frontend.fill(modalId + '-content', adminsRender);

    frontend.openModal(modalId);

    document.getElementById('status-waiting-screen').style.display = 'none';
}

document.getElementById('admin-danger-zone').addEventListener('click', async (e) => {

    let dangerZoneInfo = manageSnackbar({
        'msg'  : 'Processing...',
        'state': 'info'
    }, 'init');

    let dangerZoneTab = frontend.openTab('admin-monitoring-tab-link', 'admin-monitoring-tab-content', 'danger-zone');

    let getDangerZone = await authManager.makeAuthenticatedRequest('./admin/fetchDangerZone',
        {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            }
        });

    let dangerZoneRender = await getDangerZone.text();

    frontend.fill(dangerZoneTab + '-content', dangerZoneRender);

    manageSnackbar(dangerZoneInfo, 'close');
});