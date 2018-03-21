<template>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" v-bind:href="homelink">
            <i class="fas fa-balance-scale"></i>
            {{ $t('SkitchBB') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" :href="route('home')">{{ $t('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :href="route('feed')">{{ $t('Post Feed') }}</a>
                </li>
                <li class="nav-item" v-if="user">
                    <a class="nav-link" :href="route('users.show', {name: user.name})">{{ $t('Profile') }}</a>
                </li>
                <li class="nav-item" v-if="user && user.admin">
                    <a class="nav-link" :href="route('home')">{{ $t('Admin') }}</a>
                </li>
                <li class="nav-item" v-if="!user">
                    <a class="nav-link" :href="route('login')">{{ $t('Login') }}</a>
                </li>
                <li class="nav-item" v-if="!user">
                    <a class="nav-link" :href="route('register')">{{ $t('Register') }}</a>
                </li>
            </ul>
        </div>
        <form class="form-inline justify-content-end">
            <div class="input-group">
                <input class="form-control" type="search" :placeholder="$t('Search')" :aria-label="$t('Search')">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['homelink', 'user', 'links'],
    }
</script>
