<template>
    <div class="calendar">
        <div class="row" v-for="day in days">
            <span>{{ day }}</span>
        </div>
        <datepicker :disabledDates="disabledDates" 
                                                    :format="DatePickerFormat"
                                                    v-model="startDate">
                                        </datepicker>
                                        <datepicker :disabledDates="disabledDates" 
                                                    :format="DatePickerFormat"
                                                    v-model="endDate">
                                        </datepicker>
        <input v-model="startDate"/>
        <input v-model="endDate" />
    </div>
</template>

<script>
    import moment from 'moment';
    import Datepicker from 'vuejs-datepicker';

    export default {
        mounted() {
            console.log('Component mounted.');
            this.getDaysArray(new Date(2019,6,22), new Date(2019,7,1));
            console.log(new Date(2019,6,22) );
        },
        components: {
            'datepicker' : Datepicker
        },
        computed: {
           
        },
        data () {
            return {
                disabledDates: {
                    to: new Date(Date.now())
                },
                DatePickerFormat: "dd/MM/yyyy",
                today: moment(),
                dateContext: moment(),
                days: [],
                startDate: '',
                endDate: ''
            };
        },
        methods: {
            getDaysArray: function(startDate, endDate) {
                 var dates = [],
                  currentDate = startDate,
                  addDays = function(days) {
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                  };
              while (currentDate <= endDate) {
                var momentObj = moment(currentDate);
                var momentString = momentObj.format('Do dddd');
                dates.push(momentString);
                currentDate = addDays.call(currentDate, 1);
              }
              console.table(dates);

              this.days = dates;
              return dates;
            }
        }
         
    }
</script>
