export default async function checkSession() {
    const response = fetch('./api/checkSession', {
        method: 'POST',
        credentials: 'include'
    });

    if (!response.ok) return false;

    return await response.json();
}