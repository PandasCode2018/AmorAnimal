<main class="error-page">
    <h1 class="error-code">500</h1>
    <div class="error-message">
        Lo sentimos, error en el servidor.
    </div>
    <button class="go-back-btn" onclick="goBack()">
        Volver a la página anterior
    </button>
</main>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<style>
    .error-page {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #1A2238;
        position: relative;
    }

    .error-code {
        font-size: 9rem;
        font-weight: 800;
        color: white;
        letter-spacing: 0.1em;
    }

    .error-message {
        background-color: #FF6A3D;
        padding: 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        transform: rotate(12deg);
        position: absolute;
    }

    .go-back-btn {
        margin-top: 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #FF6A3D;
        background-color: #1A2238;
        padding: 0.75rem 2rem;
        border: 1px solid #FF6A3D;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .go-back-btn:hover {
        transform: translate(0, -0.5rem);
    }
</style>
