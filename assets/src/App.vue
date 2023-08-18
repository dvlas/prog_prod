<template>
    <div class="bg-body-tertiary p-5 rounded">
        <h1>{{ name }}</h1>
        <input type="date" v-model="input_date" /><button class="btn btn-primary" v-on:click="getFilmByDate">Найти</button>
        <div v-if="films.length === 0">
            На эту дату пока что ничего нет
        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <th>Наименование</th>
                        <th>
                            Год выпуска
                        </th>
                        <th>Рейтинг</th>
                        </thead>
                        <tbody>
                        <tr v-for="film in films" :key="film.id">
                            <td>{{ film.title }}</td>
                            <td>{{ film.year }}</td>
                            <td>{{ film.rating }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
    data(){
        return {
            name: "ТОП 10 Фильмов",
            films: [],
            input_date: null
        }
    },
    created: function (){
        this.getFilm();
    },
    methods: {
        getFilm(){
            let self = this;
            fetch('/api/films')
                .then(function (response){
                    return response.json();
                }).then(function (films){
                    self.films = films;
                })
                .catch(function (error){
                    console.log(error)
                })
        },
        getFilmByDate(){
            let self = this;
            fetch(`/api/films/${this.input_date}`)
                .then(function (response){
                    return response.json();
                })
                .then(function (films){
                    self.films = films;
                })
                .catch(function (error){
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>

</style>