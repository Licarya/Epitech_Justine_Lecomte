public class Animal {

   protected enum Type {
      MAMMAL, BIRD, FISH
   }

   private static int numberOfMammals;
   private static int numberOfBirds;
   private static int numberOfFish;
   private static int numberOfAnimals;
   private String name;
   private int legs;
   private String type;

   public String getName() {
      return name;
   }

   public int getLegs() {
      return legs;
   }

   public String getType() {
      return type;
   }

   public static int getNumberOfAnimals() {
      if (Animal.numberOfAnimals == 1) {
         System.out.println("There is currently " + Animal.numberOfAnimals + " animal in our world.");
      } else {
         System.out.println("There are currently " + Animal.numberOfAnimals + " animals in our world.");
      }
      return numberOfAnimals;
   }

   public static int getNumberOfBirds() {
      if(Animal.numberOfBirds == 1){
         System.out.println("There is currently " + Animal.numberOfBirds + " " + Type.BIRD.toString().toLowerCase()+" in our world.");
      } else {
         System.out.println("There are currently " + Animal.numberOfBirds + " " + Type.BIRD.toString().toLowerCase()+"s in our world.");

      }
       return numberOfBirds;
   }

   public static int getNumberOfFish() {
      if(Animal.numberOfFish == 1){
         System.out.println("There is currently " + Animal.numberOfFish + " " + Type.FISH.toString().toLowerCase()+" in our world.");
      } else {
         System.out.println("There are currently " + Animal.numberOfFish + " " + Type.FISH.toString().toLowerCase()+" in our world.");

      }
       return numberOfFish;
   }

   public static int getNumberOfMammals() {
      if(Animal.numberOfMammals == 1){
         System.out.println("There are currently " + Animal.numberOfMammals + " " + Type.MAMMAL.toString().toLowerCase()+" in our world.");
      } else {
         System.out.println("There is currently " + Animal.numberOfMammals + " " + Type.MAMMAL.toString().toLowerCase()+"s in our world.");

      }
       return numberOfMammals;
   }


   protected Animal(String newName, int newLegs, Type newType) {
      this.name = newName;
      this.legs = newLegs;
      Animal.numberOfAnimals++;

      switch (newType) {
         case MAMMAL:
            this.type = "mammal";
            numberOfMammals++;
            break;

         case FISH:
            this.type = "fish";
            numberOfFish++;
            break;

         case BIRD:
            this.type = "bird";
            numberOfBirds++;
            break;
      }

      System.out.println("My name is " + this.getName() + " and I am a " + this.getType() + "!");
   }

}
