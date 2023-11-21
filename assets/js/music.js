function initializeSpotify() {
    // Replace 'YOUR_CLIENT_ID' with your Spotify Developer Dashboard client ID
    const clientId = 'YOUR_CLIENT_ID';

    // Load the Spotify Web Playback SDK script
    window.onSpotifyWebPlaybackSDKReady = () => {
        const token = 'YOUR_ACCESS_TOKEN'; // Replace with a valid Spotify access token

        // Initialize the Spotify Player
        const player = new Spotify.Player({
            name: 'Web Playback SDK Quick Start Player',
            getOAuthToken: cb => { cb(token); }
        });

        // Connect to the player
        player.connect().then(success => {
            if (success) {
                console.log('The Web Playback SDK successfully connected to Spotify!');
            } else {
                console.error('The Web Playback SDK failed to connect to Spotify.');
            }
        });
    };

    // Load the Spotify Web Playback SDK script
    const script = document.createElement('script');
    script.src = 'https://sdk.scdn.co/spotify-player.js';
    document.body.appendChild(script);
}