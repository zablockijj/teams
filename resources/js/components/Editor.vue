<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Teams
                    <span class="ml-2">
                        <a href="#" data-toggle="modal" data-target="#addTeamModal">Add Team</a>
                    </span>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        v-for="team in teams"
                    >
                        <a href="#" @click.prevent="selectTeam(team)">
                            {{ team.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div v-if="team" class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    Selected Team
                </div>

                <div class="card-body d-flex justify-content-between">
                    {{ team.name }}
                </div>
            </div>

            <div v-if="team" class="card">
                <div class="card-header d-flex justify-content-between">
                    Roster
                    <span class="ml-4">
                        <a href="#" data-toggle="modal" data-target="#addPlayerModal">Add Player</a>
                    </span>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"
                        v-for="player in players"
                    >
                        <player :player="player" :key="player.id"></player>
                    </li>
                </ul>
            </div>
        </div>

        <add-team></add-team>
        <add-player v-if="team" :team="team"></add-player>
    </div>
</template>

<script>
    import api from './mixins/api';
    import Player from './Player';
    import AddTeam from './AddTeam';
    import AddPlayer from './AddPlayer';
    import { EventBus } from '../utils/event-bus.js';

    export default {
        components: {
            Player,
            AddTeam,
            AddPlayer,
        },

        mixins: [
            api,
        ],

        data() {
            return {
                teams: [],
                selectedTeam: null,
                team: null,
                players: [],
            };
        },

        created() {
            EventBus.$on('team-created', data => {
                this.loadTeams();
            });

            EventBus.$on('player-created', data => {
                this.loadPlayers()
            });

            this.loadTeams();
        },

        methods: {
            loadTeams() {
                this.getTeams()
                    .then(data => {
                        this.teams = data;
                    });
            },

            selectTeam(team) {
                this.selectedTeam = team;

                this.loadTeam();
            },

            loadTeam() {
                this.getTeam(this.selectedTeam.id)
                    .then(data => {
                        this.team = data;
                        this.players = data.players;
                    })
            },

            loadPlayers() {
                if (! this.team) {
                    return;
                }

                this.getPlayers(this.selectedTeam.id)
                    .then(data => {
                        this.players = data;
                    })
            },
        },
    }
</script>
