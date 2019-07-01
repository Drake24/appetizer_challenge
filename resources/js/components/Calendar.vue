<template>
    <div class="calendar">
        <div class="row">
            <h3>Calendar Options</h3>
            <div class="col-md-3">
                <div class="row">
                    <div class="form-group">
                        <label for="from">Event Name:</label>
                        <input class="form-control" v-model="form.event" />
                    </div>
                    <div class="form-group">
                        <label for="from">From:</label>
                        <datepicker
                            :disabledDates="disabledDates" 
                            :format="customFormatter"
                            v-model="form.startDate">
                        </datepicker>
                    </div>
                    <div class="form-group">
                        <label for="to">From:</label>
                        <datepicker
                            :disabledDates="disabledDates" 
                            :format="customFormatter"
                            v-model="form.endDate">
                        </datepicker>
                    </div>
                </div>
                <div class="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" v-model="form.checkedDates" />
                        <label class="form-check-label" for="sunday">Sun</label>
                        <input class="form-check-input" type="checkbox" value="1" v-model="form.checkedDates" />
                        <label class="form-check-label" for="monday">Mon</label>
                        <input class="form-check-input" type="checkbox" value="2" v-model="form.checkedDates" />
                        <label class="form-check-label" for="tuesday">Tue</label>
                        <input class="form-check-input" type="checkbox" value="3" v-model="form.checkedDates" />
                        <label class="form-check-label" for="wednesday">Wed</label>
                        <input class="form-check-input" type="checkbox" value="4" v-model="form.checkedDates" />
                        <label class="form-check-label" for="thursday">Thu</label>
                        <input class="form-check-input" type="checkbox" value="5" v-model="form.checkedDates" />
                        <label class="form-check-label" for="friday">Fri</label>
                        <input class="form-check-input" type="checkbox" value="6" v-model="form.checkedDates" />
                        <label class="form-check-label" for="saturday">Sat</label>
                    </div>
                </div>
                <span>Checked names: {{ form.checkedDates }}</span>
                {{ form }}
                ====================== <br />
                {{ calendar.events }}
                <button type="button" class="btn" v-on:click="save()">Save</button>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <vue-cal 
                    :time="false" 
                    :events="calendar.events"
                    :startWeekOnSunday="true"></vue-cal>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Datepicker from 'vuejs-datepicker';

    import VueCal from 'vue-cal';
    import 'vue-cal/dist/vuecal.css';

    export default {
        mounted() {
         
        },
        components: {
            'datepicker' : Datepicker,
            'vue-cal' : VueCal
        },
        computed: {
           
        },
        data () {
            return {
                disabledDates: {
                    to: new Date(Date.now())
                },
                calendar: {
                    events: [
                        {
                          start: '2019-07-01',
                          end: '2019-07-01',
                          title: 'Need to go shopping',
                        },
                        {
                          start: '2018-07-02',
                          end: '2019-07-02',
                          title: 'Golf with John',
                        },
                        {
                          start: '2018-07-03',
                          end: '2019-07-03',
                          title: 'Dad\'s birthday!',
                        }
                    ]
                },
                form: {
                    startDate: '',
                    endDate: '',
                    event: '',
                    checkedDates: []
                }
            };
        }, 
        methods: {
            customFormatter(date) {
              return moment(date).format('YYYY/MM/DD');
            },
            save: function () {
                let vm = this;
               axios({
                    params: {
                        form: this.form
                    },
                    method: 'post',
                    url: 'save',
                }).then(function (response) {
                    vm.calendar.events = response.data.data;
                }).catch(function (response) {
                    console.log(response);
                });
           }
        }
         
    }
</script>
