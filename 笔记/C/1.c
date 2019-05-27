#include <stdio.h>
#include <string.h>
#include <stdlib.h>
int main()
{
	char x;
	char b;
	printf("Please hack me:\n");
	scanf("%s",&x);
	printf("[*] Checking for new versions of pwntools\n");
	printf("To disable this functionality, set the contents of /root/.pwntools-cache/update to 'never'.\n");
	printf("[*] You have the latest version of Pwntools (3.12.2)\n");
	printf("[+] Starting local process\n");
	if(!strcmp("luluNB",&x)){
		printf("You getshell!!! luluNB is tqltqltqltqltql");
		while(1){
			printf("\n#");
			scanf("%s",&b);
			system(&b);
		}
	}else{
		printf("[-] Closing local process\n");
	}

	return 0;
}