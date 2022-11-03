import java.util.ArrayList;

public class Team {
    private String teamName;

    private ArrayList<Astronaut> team = new ArrayList<>();
    private ArrayList<String> tot = new ArrayList<String>();

    public Team(String newName) {
        this.teamName = newName;
    }

    public String getTeamName() {
        return teamName;
    }

    public void add(Astronaut name) {
        team.add(name);
    }

    public void remove(Astronaut name) {
        team.remove(name);
    }

    public int countMembers() {
        return team.size();
    }

    public void showMembers() {
        for (Astronaut tm : team) {
            String work;
            if (tm.getDestination() == null) {
                work = tm.getName() + " on standby";

            } else {
                work = tm.getName() + " on mission";

            }
            tot.add(work);
            System.out.println(this.getTeamName() + ": " + String.join(", ", tot) + ".");

        }

    }
}
