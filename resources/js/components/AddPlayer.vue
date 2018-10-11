<template>
    <div class="modal fade"
         id="addPlayerModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add New Team
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Fire name"
                               v-model="formData.first_name"
                        />
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Last name"
                               v-model="formData.last_name"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="save()">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import api from './mixins/api';
    import { EventBus } from '../utils/event-bus.js';

    export default {
        name: 'add-player',

        mixins: [
            api,
        ],

        props: {
            team: {
                type: Object,
                default() {
                    return {};
                },
            },
        },

        data() {
            return {
                formData: {
                    first_name: '',
                    last_name: '',
                },
            };
        },

        methods: {
            reset() {
                this.formData.first_name = '';
                this.formData.last_name = '';
            },

            save() {
                this.storePlayer(this.team.id, this.formData)
                    .then(data => {
                        this.close();
                        this.reset();
                        EventBus.$emit('player-created', data);
                    })
            },

            close() {
                $('#addPlayerModal').modal('hide');
            },
        },
    }
</script>