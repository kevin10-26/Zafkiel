/**
 * Gestionnaire des utilisateurs en ligne pour Zafkiel
 */
class OnlineUsersManager {
    constructor() {
        this.endpoint = '/zafkiel/api/online-admins';
        this.container = document.getElementById('online-users-container');
        this.refreshInterval = 60000; // Rafraîchir toutes les 60 secondes
        this.authManager = new AuthManager();
    }
    
    /**
     * Initialise le gestionnaire
     */
    init() {
        if (this.container) {
            this.updateOnlineUsers();
            setInterval(() => this.updateOnlineUsers(), this.refreshInterval);
        }
    }
    
    /**
     * Met à jour la liste des utilisateurs en ligne
     */
    async updateOnlineUsers() {
        try {
            const response = await this.authManager.makeAuthenticatedRequest(this.endpoint);
            
            if (!response.ok) {
                console.error('Erreur lors de la récupération des utilisateurs en ligne:', response.status);
                return;
            }
            
            const data = await response.json();
            this.renderOnlineUsers(data.online, data.stats);
            
        } catch (error) {
            console.error('Erreur lors de la mise à jour des utilisateurs en ligne:', error);
        }
    }
    
    /**
     * Affiche les utilisateurs en ligne dans le conteneur
     */
    renderOnlineUsers(users, stats) {
        if (!this.container) return;
        
        const currentAdminId = document.body.dataset.currentAdminId || '';
        
        // Mettre à jour le titre avec le nombre d'utilisateurs en ligne
        const titleElement = document.getElementById('online-users-title');
        if (titleElement) {
            titleElement.textContent = `Utilisateurs en ligne (${stats.onlineUsers})`;
        }
        
        // Générer le HTML pour chaque utilisateur en ligne
        const usersHtml = users.map(user => {
            const isCurrentUser = user.adminId == currentAdminId;
            const lastActivityTime = new Date(user.lastActivity * 1000).toLocaleTimeString('fr-FR', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return `
                <div class="flex items-center p-2 rounded-md ${isCurrentUser ? 'bg-green-800/50' : 'bg-stone-700'} mb-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                    <span class="font-medium">${user.adminName}</span>
                    <span class="text-xs text-gray-400 ml-2">${lastActivityTime}</span>
                </div>
            `;
        }).join('');
        
        // Générer le HTML pour les statistiques
        const statsHtml = `
            <div class="mt-4 text-sm text-gray-400">
                <p>${stats.onlineLast5Min} utilisateurs actifs ces 5 dernières minutes</p>
                <p>${stats.percentage.toFixed(1)}% des admins sont connectés</p>
            </div>
        `;
        
        // Mettre à jour le conteneur avec les nouveaux utilisateurs et statistiques
        this.container.innerHTML = `
            <div class="flex flex-wrap gap-2">
                ${usersHtml.length > 0 ? usersHtml : '<div class="text-gray-400">Aucun utilisateur en ligne</div>'}
            </div>
            ${statsHtml}
        `;
    }
}

/* Initialiser le gestionnaire quand la page est chargée
document.addEventListener('DOMContentLoaded', () => {
    const onlineUsersManager = new OnlineUsersManager();
    onlineUsersManager.init();
}); */