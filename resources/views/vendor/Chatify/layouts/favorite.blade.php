<div class="favorite-list-item">
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
        style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
    </div>
    <p>{{ strlen($user->nom) > 5 ? substr($user->nom,0,6).'..' : $user->nom }}</p>
    <p>{{ strlen($user->prenom) > 5 ? substr($user->prenom,0,6).'..' : $user->prenom }}</p>
</div>
