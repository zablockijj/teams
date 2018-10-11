<template>
    <div class="d-flex justify-content-between align-items-center">
        <div v-if="! editing">
            {{ playerData.first_name }} {{ playerData.last_name }}
        </div>
        <div v-else>
            <form>
                <div class="form-group">
                    <label>First name</label>
                    <input type="text"
                           class="form-control"
                           placeholder="First name"
                           v-model="formData.first_name"
                    />
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input type="text"
                           class="form-control"
                           placeholder="Last name"
                           v-model="formData.last_name"
                    />
                </div>
                <button type="submit"
                        class="btn btn-primary"
                        :class="{ 'disabled': saving }"
                        @click.prevent="save()"
                        :disabled="saving"
                >
                    Save
                </button>
            </form>
        </div>

        <span class="ml-2">
            <a href="#" @click.prevent="toggleEdit()">Edit</a>
        </span>
    </div>
</template>

<script>
    import api from './mixins/api';

    export default {
        name: 'player',

        mixins: [
            api,
        ],

        props: {
            player: {
                type: Object,
                default() {
                    return {};
                },
            },
        },

        created() {
            this.playerData = this.player;
            this.formData = this.player;
        },

        data() {
            return {
                editing: false,
                saving: false,
                playerData: {},
                formData: {},
            };
        },

        methods: {
            toggleEdit() {
                this.editing = ! this.editing;
            },

            save() {
                if (this.saving) {
                    return;
                }

                this.saving = true;

                this.updatePlayer(this.player.id, this.formData)
                    .then(data => {
                        this.formData = data;
                        this.playerData = data;
                        this.saving = false;
                        this.editing = false;
                    })
            },
        },
    }
</script>