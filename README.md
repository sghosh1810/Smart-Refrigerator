# Smart Refrigerator System

Smart Refrigerator detects amount of stuff present in a fridge and shows it to user from webapp or mobile app. 

## HOSTING

Web app can be hosted on any shared hosting site or vps. To deploy on heroku clone this repository and do

```bash
heroku login
cd proj_dir/
git init
git add .
git commit -"Initial Conmmit"
git push heroku master
```

## Packages
Following dependencies are requireds to run the cnn model which detects different items in fridge.

```python
tensorflow 1.14
protobuf
pillow
lxml
Cython
contextlib2
jupyter
matplotlib
pandas
numpy
opencv-python
firebase
firebase-admin

```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Contributors: 
[Shounak Ghosh](https://github.com/sghosh1810/)
[Arnab Roy](https://github.com/arnabroy12345/)

## License
[MIT](https://choosealicense.com/licenses/mit/)