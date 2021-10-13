# Docker Arch

[![Version](https://img.shields.io/badge/Version-1.0.0-blue)](https://github.com/hulkthedev/docker-arch)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

### Simple docker architecture for dev and prod environments.

This example will create 2 Docker images during the building. Dependencies on Redis, MySql and NGNX are resolved through configurations. Easy to use for productive and dev environments.

[![Flow](https://github.com/hulkthedev/docker-arch/blob/master/public/flow.png?raw=true)](Flow)

##### build

```bash
chmod +x build.sh
./build.sh
```

##### run

```bash
# run dev container
docker-compose up -d

# run prod container
docker-compose up -f docker-compose.yml -d
```