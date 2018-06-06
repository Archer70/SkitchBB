// $(document).ready(function() {
//     $('#new-post-form').on('submit', event => {
//         event.preventDefault();
//         vuexStore.commit('blockNewPostCheck');

//         let body = $('#post-body').val();
//         $('#post-body').prop('disabled', true).val('');
//         axios.post(
//             route('posts.store'),
//             {
//                 body: body,
//                 topic_id: $('#topic-id').val()
//             }
//         ).then(response => {
//             vuexStore.commit('addPosts', response.data);
//             vuexStore.commit('unblockNewPostCheck');
//             $('#post-body').prop('disabled', false);
//         }).catch(response => {
//             // Don't keep going.
//         })
//     })
// })
