<template>
    <div>
        <div v-if="rooms" v-for="(room, index) in rooms">
            <div class="mp-ChatRoom">
                <div class="mp-ChatRoom_Name">ルーム名: {{ room.name }}</div>
                <div>
                    <span>ルームID: </span>
                    <input type="text" :value="room.room_id " :id="'copy' + index + 'mp'">
                    <button class="btn st-Tooltip_Button" :data-clipboard-target="'#copy' + index + 'mp'">
                        <span class="st-Tooltip">Copy</span>
                        <i class="fas fa-clipboard"></i>
                    </button>
                    <i v-if="room.publish === 'private'" class="fas fa-unlock-alt"></i>
                </div>
                <div>作成者: {{ room.creator }}</div>
                <div class="mp-ChatRoom_Tag">
                    <span class="st-Tag" v-for="(tag) in tags[index]">{{ tag }}</span>
                </div>
                <div class="mp-ChatRoom_Description">
                    <p>{{ room.description }}</p>
                </div>
                <div class="mp-ChatRoom_LinkBox">
                    <a :href="'/room/' + room.room_id" class="mp-ChatRoom_Link">チャットルームへ</a>
                </div>
            </div>
        </div>
        <div v-if="rooms.length <= 0">
            <p class="mp-Not_CreateRoom">ルームはまだ作成されていません。</p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Clipboard from 'clipboard'

    export default {
        data() {
            return {
                rooms: {},
                tags: []
            }
        },
        methods: {
            getRooms() {
                axios.get('/api/mypage/create')
                    .then(response => {
                        this.rooms = response.data

                        for (let i = 0; i < response.data.length; i++) {
                            this.tags.push(JSON.parse(response.data[i].tags))
                        }
                    })
            }
        },
        created() {
            this.getRooms()
            const clipboard = new Clipboard('.btn');
        }
    }
</script>