public class Ex06 {

    public static void sequence(int n) {
        String start = "1";
        int repet =0;
        System.out.println(start);
       while(repet < n){
                int carac = 0;
                int counter = 0;
                String res = "";
                String[] number = start.split("");
                for (String chiffre : number) {
                    int nb = Integer.parseInt(chiffre);
                    if (carac != nb) {
                        if (counter != 0) {
                            res = res + counter + carac;
                        }
                        carac = nb;
                        counter = 1;
                    } else {
                        counter = counter + 1;
                    }
                }
                res = res + counter + carac;
                System.out.println(res);
                start = res;
                repet++;

        }
    }

}
