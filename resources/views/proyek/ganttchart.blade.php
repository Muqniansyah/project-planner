<div id="gantt_here" style="width:100%; height:500px; overflow-x:auto;"></div>
<script type="text/javascript">
    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";

    gantt.init("gantt_here");

    gantt.load("/api/data/{{ $project->id }}");

    var dp = new gantt.dataProcessor("/api");
    dp.init(gantt);
    dp.setTransactionMode("REST", true); // Menggunakan mode REST dengan JSON
    console.log("Gantt data load URL:", "/api/data/{{ $project->id }}");

    dp.attachEvent("onBeforeUpdate", function(id, task, action) {
        action.project_id = {{ $project->id }};
        console.log(action);
        return action;
    });

    // Ensure horizontal scrolling is enabled
    gantt.attachEvent("onRender", function() {
        const ganttContainer = document.getElementById("gantt_here");
        ganttContainer.style.overflowX = "auto"; // Enable horizontal scroll if needed
    });
</script>
