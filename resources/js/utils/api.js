export async function getTeams() {
    try {
        const { data } = await axios.get(`/api/teams`);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export async function getTeam(teamId) {
    try {
        const { data } = await axios.get(`/api/teams/${teamId}`);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export async function getPlayers(teamId) {
    try {
        const { data } = await axios.get(`/api/teams/${teamId}/players`);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export async function storeTeam(payload) {
    try {
        const { data } = await axios.post(`/api/teams`, payload);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export async function storePlayer(teamId, payload) {
    try {
        const { data } = await axios.post(`/api/teams/${teamId}/players`, payload);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export async function updatePlayer(playerId, payload) {
    try {
        const { data } = await axios.put(`/api/players/${playerId}`, payload);
        return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}
