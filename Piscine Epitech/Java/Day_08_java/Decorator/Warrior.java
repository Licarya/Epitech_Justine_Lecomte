package Decorator;

public abstract class Warrior {
    protected int hp;
    protected int dmg;

    public int getDmg() {
        return this.dmg;
    }

    public int getHp() {
        return this.hp;
    }
}
