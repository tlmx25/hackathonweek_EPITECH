<template>
    <div class="">
        <div class="card p-3" style="width: 100%;">
            <div id="chartdiv2"></div>
        </div>
    </div>
</template>

<script>
import am5themes_Animated from "@amcharts/amcharts5/themes/Animated";
import * as am5 from "@amcharts/amcharts5";
import * as am5percent from "@amcharts/amcharts5/percent";

export default {
    data() {
        return {
            postes: [],
            agences: [],
            equipes: [],
        }
    },
    props: {
        users: {
            type: Array,
            required: true,
        }
    },
    methods: {
        generatePie() {
            let root = am5.Root.new("chartdiv2");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            let chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    endAngle: 270,
                    paddingTop: 80,
                })
            );

            let title = am5.Label.new(root, {
                text: "Graphique des Agences",
                fontSize: 25,
                fontWeight: "700",
                textAlign: "center",
                x: am5.percent(1),
                y: am5.percent(-25),
                centerX: am5.percent(0),
                paddingTop: 0,
                paddingBottom: 0,
                marginBottom: 0,
            });

            chart.children.unshift(title);

            let series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "category",
                    endAngle: 270,
                    labelRadius: am5.percent(80),
                })
            );

            series.labels.template.setAll({
                fontSize: 10,
            });

            series.states.create("hidden", {
                endAngle: -90
            });

            const data = this.agences.map(agence => ({
                category: agence.agence,
                value: agence.count
            }));
            series.data.setAll(data);

            series.appear(1000, 100);
        },
        agenciesP() {
            const agencesCount = {};
            const totalPersons = this.users.length;
            this.users.forEach(user => {
                const agence = user.agency;
                if (!agencesCount[agence]) {
                    agencesCount[agence] = { count: 1, percentage: 0 };
                } else {
                    agencesCount[agence].count++;
                }
            });
            Object.keys(agencesCount).forEach(agence => {
                agencesCount[agence].percentage = (agencesCount[agence].count / totalPersons) * 100;
            });
            this.agences = Object.entries(agencesCount).map(([agence, data]) => ({ agence, ...data }));
        }
    },
    mounted() {
        this.agenciesP();
        this.generatePie();
    }
}
</script>

<style scoped>
#chartdiv2 {
    width: 100%;
    height: 400px;
  }
</style>