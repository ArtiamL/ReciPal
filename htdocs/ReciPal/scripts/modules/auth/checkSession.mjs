export default async function checkSession() {
    const response = fetch('./api/checkSession', {
        method: 'POST',
        credentials: 'include'
    })
        .then(res => {
            if (!res.ok) {
                return false;
            }

            return res.json();
        })
        // .then(data => console.log(data))
        .catch(err => console.log(err));

    // if (!response.ok) {
    //     console.log(await response.status);
    //     return false;
    // }

    return await response;
}