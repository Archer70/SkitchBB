<template>
    <div class="card user-card">
        <div class="card-body">
            <h5 :class="'card-title text-center' + (responsive ? ' responsive-title' : '')">
                <a :href="route('users.show', user)">
                    {{ user.name }}
                </a>
            </h5>
            <img :class="responsive ? 'card-avatar responsive-image' : 'card-avatar'" :src="user.avatarUrl" alt="">
        </div>
        <ul :class="'list-group list-group-flush' + (responsive ? ' sm-hide' : '')">
            <li class="list-group-item">
                <div v-if="badgeUrl()">
                    <img class="user_group_badge" :src="badgeUrl()">
                </div>
                <span v-if="!badgeUrl()">{{ user.group.name }}</span>
            </li>
            <li v-if="user.title" class="list-group-item">
                {{ user.title }}
            </li>
            <li class="list-group-item">
                Posts: {{ user.post_count }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['user', 'responsive'],
        data: function() {
            return {
                assetUrl: window.asset_url,
                userGroup: this.user.group,
            }
        },
        methods: {
            badgeUrl: function() {
                if (this.userGroup.icon) {
                    return this.userGroup.icon;
                } else if (this.userGroup.id == 2) {
                    return this.assetUrl + 'images/admin_icon.png';
                } else if (this.userGroup.id == 3) {
                    return this.assetUrl + 'images/admin_icon.png';
                }
                return '';
            },
        },
    }
</script>