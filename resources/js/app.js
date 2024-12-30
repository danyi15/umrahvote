import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel('votes')
    .listen('VoteUpdated', (event) => {
        console.log('Vote updated:', event.candidate);  // Debugging log
        updateVoteUI(event.candidate);  // Memperbarui UI dengan data kandidat
    });

function updateVoteUI(candidate) {
    // Pastikan ID kandidat sesuai dengan format di HTML
    const candidateElement = document.getElementById(`candidate-${candidate.id}`);

    if (candidateElement) {
        // Perbarui tampilan jumlah suara menggunakan votes_count
        candidateElement.querySelector('.votes-count').textContent = candidate.votes_count;
    }
}
