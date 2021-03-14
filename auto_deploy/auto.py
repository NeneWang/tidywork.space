import subprocess
import re
import datetime, time

with open('pass.txt', 'r') as file:
    auth = file.read()
    
with open('repo.txt', 'r') as file:
    repo = file.read()
    
def retrieve_hash():
    with open('hash.txt', 'r') as file:
        version = file.read()
    return version

def store_hash(lastest_version):
    f_write = open('hash.txt', 'w')
    f_write.write(str(lastest_version))
    f_write.close()
    return
    
def remote_hash(repo_url):
    process = subprocess.Popen(["git", "ls-remote", repo_url], stdout=subprocess.PIPE)
    stdout, stderr = process.communicate()
    sha = re.split(r'\t+', stdout.decode('ascii'))[0]
    return sha
    
def time_print(text):
    print('{}: '.format(datetime.datetime.now()) + text)
    return

time_print('Startup complete')

while True:
    time_print('Checking for update...')
    remote = remote_hash(repo)
    local = retrieve_hash()
    
    if remote == local:
        time_print('Nothing to update')
        time.sleep(5)
    else:
        time_print('New version found')
        pid1 = subprocess.run(["rm", "-r", "-f", "tidywork.space"])
        pid2 = subprocess.run(["rm", "-r", "-f", "/var/www/tidywork.space/*"])
        pid3 = subprocess.run(["git", "clone", repo])
        pid4 = subprocess.run(["cp -f /home/site_admin/tidywork.space/frontend/* /var/www/tidywork.space"], shell=True)
        cmd1 = subprocess.Popen(['echo', auth], stdout=subprocess.PIPE)
        pid5 = subprocess.run(["sudo", "-S", "nginx", "-t"])
        cmd2 = subprocess.Popen(['echo', auth], stdout=subprocess.PIPE)
        pid6 = subprocess.run(["sudo", "-S", "nginx", "-s", "reload"])
        store_hash(remote)
        time_print('Updated successfully')
        time.sleep(5)