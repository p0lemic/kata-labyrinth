## Labyrinth
Given a matrix with 0s (walkable path) and 1s (wall), and a goal coordinates write a function that returns true or 
false if from every 0 you can find a path to the goal.

```
[0, 0, 0, 0, 0, 0]
[0, 1, 1, 1, 1, 0]
[0, 1, 0, 0, 1, 0]
[0, 1, 1, 1, 1, 0]
[0, 0, 0, 0, 0, 0]

[0, 4]

output -> false
```

```
[0, 0, 0, 0, 0, 0]
[0, 0, 0, 0, 0, 1]
[1, 1, 1, 1, 1, 1]
[1, 1, 1, 1, 1, 1]
[1, 1, 1, 1, 1, 1]

[0, 4]

output -> true
```

### Execute phpunit
You can execute phpunit directly with your local dependencies
```
vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```
or you can use Docker using this bash script 
```
./test.sh
```
