<div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Konfirmo Fshirjen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Mbyll"></button>
            </div>
            <div class="modal-body">
                Je i sigurt që dëshiron të fshish postimin <strong>"{{ $post->title }}"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anulo</button>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Po, Fshi</button>
                </form>
            </div>
        </div>
    </div>
</div>